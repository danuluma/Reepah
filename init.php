<?php
/**
 * @package Osen Framework
 * @author Mauko/Benign < mauko@benign.co.ke >
 * @link https://benign.co.ke/products/osen
 * @version 0.18.04
 */
// Start php session
session_start();

//Load external libraries
if ( file_exists( __DIR__.'/vendor/autoload.php' ) ) {
	require_once( __DIR__.'/vendor/autoload.php' );
}

// Load dotenv
$dotenv = new Dotenv\Dotenv( __DIR__ );
$dotenv->load();

// Define constants
define( 'BASE', __DIR__.'/' );
define( 'APP', __DIR__.'/app/' );
define( 'THEMES', __DIR__.'/app/views/' );
define( 'MODULES', __DIR__.'/app/modules/' );

// Load classes added in modules
spl_autoload_register( function( $class ) {
	if ( strpos( $class, 'Extend' ) !== 0 ) {
		return;
	}

	$class 		= str_replace( "Extend\\", "", $class );
	$classpath 	= strtolower( str_replace( "\\", "/", $class ) );
	require_once( MODULES. $classpath . '.php' );
});

// Load database configuration
$GLOBALS['dbconfig'] 	= array(
	'user' 		=> getenv( 'database_user' ),
	'password' 	=> getenv( 'database_password' ),
	'host' 		=> getenv( 'database_host' ),
	'database' 	=> getenv( 'database_name' ),
	'port' 		=> getenv( 'database_port' ),
	'prefix'    => getenv( 'database_prefix' )
);

//Load functions files
require_once( BASE.'app/functions/general.php' );
require_once( BASE.'app/functions/utility.php' );
require_once( BASE.'app/functions/routing.php' );
require_once( BASE.'app/functions/api.php' );
require_once( BASE.'app/functions/front.php' );
require_once( BASE.'app/functions/admin.php' );

// Load routes
require_once( BASE.'routes.php' );