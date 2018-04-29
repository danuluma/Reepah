<?php
namespace App;
/**
* 
*/
class Router
{
    public static $routes = array();
    public static $theme;
    
    private function __construct(){
        self::$theme = getenv( 'theme' );
    }
    
    public static function add_route( $route, $function, $template = 'home' )
    {
        $section    = is_array( $route ) ? $route[0] : 'front';
        $base       = is_array( $route ) ? $route[1] : $route;
        self::$routes[$section][$base] = array( 'function' => $function, 'template' => $template );
    }

    public static function front_route( $base, $args = array() )
    {
        $dwoo           = new \Dwoo\Core();
        $theme          = getenv('theme');

        if ( isset( self::$routes['front'][$base] ) ) {
            $callable   = self::$routes['front'][$base];
            $template   = $callable['template'];
            $template   = file_exists( THEMES."{$theme}/public/{$template}.tpl" ) ? THEMES."{$theme}/public/{$template}.tpl" : THEMES."default/public/{$template}.tpl";
            if( !file_exists( $template ) ){ $template = THEMES."default/public/home.tpl"; }
            $data       = call_user_func_array( $callable['function'], $args );

            if ( isset( $data['error'] ) ) {
                $template   = file_exists( THEMES."{$theme}/public/404.tpl" ) ? THEMES."{$theme}/public/404.tpl" : THEMES."default/public/404.tpl";
                $data       = ["error" => "No records found for '{$base}'"];
            }
        } else {
		    $template   = file_exists( THEMES."{$theme}/public/page.tpl" ) ? THEMES."{$theme}/public/page.tpl" : THEMES."default/public/page.tpl";
            $posts      = new Data\Base( 'posts' );
            $data       = $posts -> single( [ 'slug' => $base ] );
        }
        
        echo $dwoo->get( $template, [ 'records' => $data, 'system' => $_ENV, 'session' => $_SESSION, 'request' => getenv('home')."/{$base}" ] );
    }

    public static function admin_route( $base, $args = array() )
    {
        $dwoo           = new \Dwoo\Core();
        $theme          = getenv( 'theme' );

        if ( isset( self::$routes['admin'][$base] ) ) {
            $callable   = self::$routes['admin'][$base];
            $template   = $callable['template'];
            $template   = file_exists( THEMES."{$theme}/admin/{$template}.tpl" ) ? THEMES."{$theme}/admin/{$template}.tpl" : THEMES."default/admin/{$template}.tpl";

            if( !file_exists( $template ) ){ $template = THEMES."default/admin/dashboard.tpl"; }
            $data       = call_user_func_array( $callable['function'], $args );
        } else {
            $template   = file_exists( THEMES."{$theme}/public/404.tpl" ) ? THEMES."{$theme}/public/404.tpl" : THEMES."default/public/404.tpl";
            $data       = ["error" => "No route set for '{$base}'"];
        }

        echo $dwoo->get( $template, [ 'records' => $data, 'system' => $_ENV, 'session' => $_SESSION, 'request' => getenv('home')."/admin/{$base}" ] );
    }

    public static function api_route( $base, $args = array() )
    {
        if ( isset( self::$routes['api'][$base] ) ) {
            $callable   = self::$routes['api'][$base];
            $data       = call_user_func_array( $callable['function'], $args );

            os_send_json( $data );
        }
    }
}