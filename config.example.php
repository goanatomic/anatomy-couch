<?php

    if ( !defined('K_COUCH_DIR') ) die(); // cannot be loaded directly

    define( 'K_SITE_OFFLINE', 0 );
    //define( 'K_SITE_URL', 'http://localhost:8888/anatomy/' );
    //define( 'K_ADMIN_PAGE', 'index.php' );
    define( 'K_CHARSET', 'utf-8' );

    date_default_timezone_set( 'America/New_York' );
    if(date('I')){
        define( 'K_GMT_OFFSET', -4 );
    } else {
        define( 'K_GMT_OFFSET', -5 );
    }

    define( 'K_DB_NAME', 'site_anatomy' );
    define( 'K_DB_USER', 'root' );
    define( 'K_DB_PASSWORD', 'root' );
    define( 'K_DB_HOST', 'localhost' );
    //define( 'K_DB_TABLES_PREFIX', '' );

    define( 'K_PRETTY_URLS', 0 );
    define( 'K_USE_CACHE', 0 );
    define( 'K_CACHE_PURGE_INTERVAL', 24 );
    define( 'K_MAX_CACHE_AGE', 7 * 24 ); // Default is 7 days

    //define( 'K_UPLOAD_DIR', 'myuploads' );
    define( 'K_SNIPPETS_DIR', 'embed' );

    define( 'K_EMAIL_TO', '' );
    define( 'K_EMAIL_FROM', '' );
    define( 'K_USE_ALTERNATIVE_MTA', 0 );

    define( 'K_GOOGLE_KEY', '' );

    define( 'K_PAYPAL_USE_SANDBOX', 1 );
    define( 'K_PAYPAL_EMAIL', '' );
    define( 'K_PAYPAL_CURRENCY', 'USD' );

    define( 'K_COMMENTS_REQUIRE_APPROVAL', 1 );
    define( 'K_COMMENTS_INTERVAL', 5 * 60 );

    define( 'K_ADMIN_LANG', 'EN' );

    //define( 'K_HTML4_SELFCLOSING_TAGS', 1 );

    define( 'K_EXTRACT_EXIF_DATA', 0 );
    define( 'K_USE_KC_FINDER', 1 );

    define( 'K_ADMIN_THEME', 'carbon' );

    define( 'K_RECAPTCHA_SITE_KEY', '' );
    define( 'K_RECAPTCHA_SECRET_KEY', '' );

    // Tokbox
    define( 'K_TOKBOX_EMBED_ID', '00dadf97-449e-4bbf-a015-426ec4b10e81' );
    define( 'K_TOKBOX_KEY', '' );
    define( 'K_TOKBOX_SECRET', '' );


    define( 'K_PAID_LICENSE', 0 );

    //define( 'K_LOGO_LIGHT', 'couch_light.png' );
    //define( 'K_LOGO_DARK', 'couch_dark.png' );
    //define( 'K_ADMIN_FOOTER', '<a href="http://www.yourcompany.com">COMPANY NAME</a>' );

    define( 'K_REMOVE_FOOTER_LINK', 1 );