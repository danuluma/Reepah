<?php
namespace App;
/**
* 
*/
class Scripts
{
    public static $scripts = array();
    
    private function __construct(){}
    
    public static function add( $script, $base = '', $location = 'footer', $extra = null )
    {
        switch ( $base ) {
            case 'local':
                $baseurl    = getenv( 'home' ).'/app/assets/js/';
                break;

            case 'theme':
                $theme      = getenv( 'theme' );
                $themedir   = is_dir( THEMES.$theme ) ? $theme : 'default';
                $baseurl    = getenv( 'home' ).'/app/views/'.$theme.'/assets/js/';
                break;
            
            default:
                $baseurl    = '';
                break;
        }
        
        self::$scripts[$location][] = $baseurl.$script;
    }

    public static function show( $location )
    {
        foreach( self::$scripts[$location] as $script ) {
            echo $script = '<script src="'.$script.'" ></script>';
        }
    }
}