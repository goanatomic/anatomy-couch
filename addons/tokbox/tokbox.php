<?php

if ( !defined('K_COUCH_DIR') ) die(); // cannot be loaded directly

use OpenTok\OpenTok;
use OpenTok\MediaMode;
use OpenTok\Session;
use OpenTok\Role;
$opentok = new OpenTok(K_TOKBOX_KEY, K_TOKBOX_SECRET);

class TokboxSessionId {
    public static function generateSessionId(){
    	global $opentok;
		$session = $opentok->createSession(array('mediaMode' => MediaMode::ROUTED));
		return $session->getSessionId();
    }
}

class TokboxToken {
	public static function newToken($params, $node){
		global $opentok, $FUNCS;
		if( count($node->children) ) {die("ERROR: Tag \"".$node->name."\" is a self closing tag");}
        extract( $FUNCS->get_named_vars(
		    array(
				'session' => '',
				'role' => '',
				'name' => ''
	         ), $params)
		);
		if ($role = 'moderator') {
			$role = Role::MODERATOR;
		}
        $session = trim($session);
		$token = $opentok->generateToken($session, array(
			'role'       => $role,
			'expireTime' => time()+(1 * 24 * 60 * 60), // in one day
			'data'       => 'name=' . $name,
			'initialLayoutClassList' => array('focus')
		));
		return $token;
	}
}

$FUNCS->register_tag( 'tokbox_session', array('TokboxSessionId', 'generateSessionId') );
$FUNCS->register_tag( 'tokbox_token', array('TokboxToken', 'newToken') );