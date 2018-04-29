<?php
namespace App;
/**
* 
*/
class Images
{
    public static $stylesheets = array();
    
    private function __construct(){}
    
    public static function add( $stylesheet, $base = '', $extra = null )
    {
        switch ( $base ) {
            case 'local':
                $baseurl        = getenv( 'home' ).'/app/assets/css/';
                break;

            case 'theme':
                $theme          = getenv( 'theme' );
                $themedir       = is_dir( THEMES.$theme ) ? $theme : 'default';
                $baseurl        = getenv( 'home' ).'/app/views/'.$theme.'/assets/css/';
                break;
            
            default:
                $baseurl        = '';
                break;
        }

        self::$stylesheets[]    = $baseurl.$stylesheet;
    }

    public static function show()
    {
        foreach( self::$stylesheets as $stylesheet ) {
            echo '<link rel="stylesheet" type="text/css" href="'.$stylesheet.'" >';
        }
    }
}