<?php
/**
 * @package Osen Framework
 * @author Mauko/Benign < mauko@benign.co.ke >
 * @link https://benign.co.ke/products/osen
 * @version 0.18.04
 */
require_once( __DIR__.'/init.php' );
$_SESSION['utype'] = 'admin';
$y = date( 'Y' );
$m = date( 'm' );
$d = date( 'd' );

$dir = __DIR__."/uploads/{$y}/{$m}/{$d}";
if ( !is_dir( $dir ) ) {
	mkdir( $dir, 0777, true ) or die( 'Could not create directory');
}

if ( in_array( $_SERVER['REMOTE_ADDR'], [ '127.0.0.1', '::1' ] ) ) {
	if ( $_SERVER['DOCUMENT_ROOT'] !== __DIR__ ){
		$dir 		= '/'.basename( __DIR__ ).'/';
		$l 			= strlen( $dir );
		$request 	= substr( $_SERVER['REQUEST_URI'], $l );
	 } else {
	 	$request 	= ltrim( $_SERVER['REQUEST_URI'], '/' );
	 }
} else {
  	$request 		= ltrim( $_SERVER['REQUEST_URI'], '/' );
}

$request 			= explode( '/', $request );
$match 				= $request[0];
array_shift( $request );

if( !isset( $match ) || empty( $match ) ){
	os_render( 'home', $request );
} else switch ( $match ) {
	case 'admin':
		$match = $request[0] ?? 'dashboard';
		array_shift( $request );
		os_admin( $match, $request );
		break;

	case 'api':
		$match = $request[0] ?? 'rest';
		array_shift( $request );
		os_api( $match, $request );
		break;
	
	default:
		os_register();
		os_login();
		os_render( $match, $request );
		break;
}