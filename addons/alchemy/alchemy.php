<?php

if ( !defined('K_COUCH_DIR') ) die(); // cannot be loaded directly

class YouTubeHandler {
	public static function getID($params, $node){
		$FUNCS;
		if( count($node->children) ) {die("ERROR: Tag \"".$node->name."\" is a self closing tag");}
        extract( $FUNCS->get_named_vars(
		    array(
				'string'=>'',
	         ), $params)
		);
        $string = trim($string);
		preg_match_all('#(?<=v=|v\/|vi=|vi\/|youtu.be\/)[a-zA-Z0-9_-]{11}#', $string, $matches);
		return $matches[0][0];
	}
}

$FUNCS->register_tag( 'youtube_id', array('YouTubeHandler', 'getID') );