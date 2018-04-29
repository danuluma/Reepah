<?php

function os_render( $route, $args = array() )
{
	return App\Router::front_route( $route, $args );
}

function os_admin( $route, $args = array()  )
{
	if( is_null( $route ) || empty( $route ) ) $route = 'dashboard';
    return App\Router::admin_route( $route, $args );
}

function os_api( $route, $args = array() )
{
    return App\Router::api_route( $route, $args );
}

function os_route( $route, $function, $template = 'home' )
{
    return App\Router::add_route( $route, $function, $template );
}