<?php
os_route( 'home', 'show_home', 'home' );
os_route( 'login', 'os_login', 'login' );
os_route( [ 'admin', 'dashboard' ], 'show_home', 'dashboard' );
os_route( [ 'admin', 'users' ], 'show_home', 'users' );
os_route( [ 'admin', 'destinations' ], 'show_home', 'destinations' );

os_route( [ 'admin', 'settings'], 'os_admin_url', 'settings' );

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