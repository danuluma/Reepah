<?php
os_route( 'home', 'show_home', 'home' );
os_route( 'login', 'os_login', 'login' );
os_route('artist', 'profile', 'artist');
os_route('lyrics', 'lyric', 'page');
function lyric( $user = null)
{
	$users = new App\Data\Base('posts');
	return $users-> single(['id' => $user]);
}
function profile( $user = null)
{
	$users = new App\Data\Base('users');
	return $users-> single(['username' => $user]);
}

os_route( 'trending', 'trending_today', 'archive');
function trending_today(){
	return array( 'page' => 'Trending' );
}

os_route( 'recent', 'recent', 'archive');
function recent(){
	return array( 'page' => 'Recently Uploaded' );
}

os_route( 'top-artists', 'top_artists', 'archive');
function top_artists(){
	return array( 'page' => 'Top Artists' );
}


os_route( [ 'admin', 'dashboard' ], 'show_home', 'dashboard' );
os_route( [ 'admin', 'users' ], 'os_admin_users', 'users' );
os_route( [ 'admin', 'destinations' ], 'show_home', 'destinations' );

os_route( [ 'admin', 'settings'], 'os_admin_url', 'settings' );
os_route( [ 'admin', 'videos'], 'os_admin_videos', 'videos' );
os_route( [ 'admin', 'audio'], 'os_admin_audio', 'audio' );
os_route( [ 'admin', 'images'], 'os_admin_images', 'images' );
os_route( [ 'admin', 'create'], 'os_admin_videos', 'create' );

function os_admin_users(string $type = null)
{
	$video = new App\Data\Base( 'users' );
	$videos = $video -> fetch(  ); //[ 'status' => $status]
	return array( 'type' => $type, 'users' => $videos ); 
}

function os_admin_videos(string $status = null)
{
	$video = new App\Data\Base( 'posts' );
	$videos = $video -> fetch(  ); //[ 'status' => $status]
	return array( 'status' => $status, 'videos' => $videos ); 
}

function os_admin_audio(string $status = null)
{
	$video = new App\Data\Base( 'posts' );
	$videos = $video -> fetch(  ); //[ 'status' => $status]
	return array( 'status' => $status, 'audio' => $videos ); 
}

function os_admin_images(string $status = null)
{
	$video = new App\Data\Base( 'posts' );
	$videos = $video -> fetch(  ); //[ 'status' => $status]
	return array( 'status' => $status, 'images' => $videos ); 
}

/**
 * ##################################################################
 * ADD YOUR ROUTES HERE, IN THE FORM os_route( $route, $function, $args );
 * Note: $route can be an array, with the first member being either admin|api and the second being the index to route
 * ##################################################################
*/

$styles = array( "bootstrap", "font-awesome.min.css" );
foreach ($styles as $style ) {
	os_style( $style, 'local' );
}

$scripts = array( "jquery-3.2.1.min.js", "bootstrap.bundle.min.js", "jquery.easing.min.js" ); 
foreach ($scripts as $script ) {
	os_script( $script, 'local', 'footer' );
}

os_add_meta( "description", "A front-end template that helps you build fast, modern mobile web apps." );
os_add_meta( "viewport", "width=device-width, initial-scale=1" );
os_add_meta( "mobile-web-app-capable", "yes" );
os_add_meta( "apple-mobile-web-app-capable", "yes" );
os_add_meta( "apple-mobile-web-app-status-bar-style", "primary" );
os_add_meta( "apple-mobile-web-app-title", "Material Design Lite" );
os_add_meta( "msapplication-TileImage", "images/touch/ms-touch-icon-144x144-precomposed.png" );
os_add_meta( "msapplication-TileColor", "#3372DF" );