<?php
if ( !defined('K_COUCH_DIR') ) die(); // cannot be loaded directly
require_once( K_COUCH_DIR . 'addons/bootstrap-grid/bootstrap-grid.php' );
require_once( K_COUCH_DIR . 'addons/cart/cart.php' );
//require_once( K_COUCH_DIR . 'addons/inline/inline.php' );
require_once( K_COUCH_DIR . 'addons/extended/extended-folders.php' );
//require_once( K_COUCH_DIR . 'addons/extended/extended-comments.php' );
require_once( K_COUCH_DIR . 'addons/extended/extended-users.php' );
require_once( K_COUCH_DIR . 'addons/routes/routes.php' );
//require_once( K_COUCH_DIR . 'addons/jcropthumb/jcropthumb.php' );
require_once( K_COUCH_DIR . 'addons/minify-js-css/minify.php' );
require_once( K_COUCH_DIR . 'addons/tiny-html-minifier/TinyMinify.php' );
require_once( K_COUCH_DIR . 'addons/uid/uid.php' );
require_once( K_COUCH_DIR . 'addons/csv/csv.php' );
require_once( K_COUCH_DIR . 'addons/filter/filter.php' );
// require_once( K_COUCH_DIR . 'addons/cardconnect/cardconnect.php' );

// Requires composer
require( K_COUCH_DIR . '../vendor/autoload.php' );


// Allow deletion of fields when using custom routes
$FUNCS->add_event_listener( 'post_process_page_start', 'my_post_process_page' );
function my_post_process_page(){
    global $PAGE, $CTX;

    if( $CTX->ignore_context ){
        $PAGE->is_master=0;
    }
}



// Save and back buttons
if( defined('K_ADMIN') ){ // if admin-panel being displayed ..

    // 1. Add a 'Save and back' button to form view
    $my_target_action = 'page'; // available targets on the form are - toolbar, filter, page and extended

    $FUNCS->add_event_listener( 'alter_pages_form_'.$my_target_action.'_actions', 'my_add_button' );
    function my_add_button( &$arr_actions, &$obj ){
        global $FUNCS, $PAGE;

        $route = $FUNCS->current_route;
        if( is_object($route) && $route->module=='pages' ){

            if( $PAGE->tpl_is_clonable ){ // if template is clonable, add the new button to form

                $arr_actions['btn_save_and_back'] =
                    array(
                        'title'=>'Save and go back',
                        'onclick'=>array(
                            "$('#btn_submit').trigger('my_submit');",
                            "var form = $('#".$obj->form_name."');",
                            "form.find('#k_custom_action').val('save_and_back');",
                            "form.submit();",
                            "return false;",
                        ),
                        'icon'=>'collapse-left',
                        'weight'=>15,
                    );
            }
        }
    }

    // 2. When the button above submits the form, take custom action (go back to list-view in this case)
    $FUNCS->add_event_listener( 'pages_form_custom_action', 'my_add_button_action' );
    function my_add_button_action( $custom_action, &$redirect_dest, &$pg, $_mode ){
        global $FUNCS, $PAGE;

        $route = $FUNCS->current_route;
        if( is_object($route) && $route->module=='pages' ){

            if( $custom_action === 'save_and_back' ){
                // set the new redirect destination (the list view with all querystring parameters) ..

                if( $PAGE->tpl_is_clonable ){
                    $link = $FUNCS->generate_route( $PAGE->tpl_name, 'list_view' );
                    $link = $FUNCS->get_qs_link( $link );

                    $redirect_dest = $link;
                }
            }
        }
    }
}





// add new sidebar menu items
if( defined('K_ADMIN') ){
    $FUNCS->add_event_listener( 'register_admin_menuitems', 'my_register_admin_menuitems' );
    $FUNCS->add_event_listener( 'alter_admin_menuitems', 'my_alter_admin_menuitems' );

    function my_register_admin_menuitems(){
        global $FUNCS;
        $FUNCS->register_admin_menuitem( array('name'=>'resources', 'title'=>'Resources', 'is_header'=>'1', 'weight'=>'70')  );
        $FUNCS->register_admin_menuitem( array('name'=>'records', 'title'=>'Records', 'is_header'=>'1', 'weight'=>'80')  );
    }

    function my_alter_admin_menuitems( &$items ){
        global $FUNCS;
        $items['_modules_']['weight']=100; // move administration group further down
    }
}