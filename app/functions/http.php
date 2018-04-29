<?php
/**
 * @package Osen Framework
 * @subpackage HTTP App\Caller - Wrapper functions for App\Caller
 * @author Mauko Maunde < mauko@disruptiing.com >
 * @since 0.18.03
 * @version 1.04
 */

/**
 * Send a generic(GET) request
 */
function os_request( string $url, array $headers = array(), array $options = array() ) 
{
	return App\Caller::get($url, $headers, null, $options);
}

/**
 * Send a GET request
 */
function os_remote_get( string $url, array $headers = array(), array $options = array() ) 
{
	return App\Caller::get($url, $headers, null, $options);
}

/**
 * Send a HEAD request
 */
function os_remote_head( string $url, array $headers = array(), array $data = array(), array $options = array() ) 
{
	return App\Caller::head($url, $headers, $data, $options);
}

/**
 * Send a DELETE request
 */
function os_remote_delete( string $url, array $headers = array(), array $data = array(), array $options = array() ) 
{
	return App\Caller::delete($url, $headers, $data, $options);
}

/**
 * Send a TRACE request
 */
function os_remote_trace( string $url, array $headers = array(), array $data = array(), array $options = array() ) 
{
	return App\Caller::trace($url, $headers, $data, $options);
}

/**
 * Send a POST request
 */
function os_remote_post( string $url, array $headers = array(), array $data = array(), array $options = array() ) 
{
	return App\Caller::post($url, $headers, $data, $options);
}

/**
 * Send a PUT request
 */
function os_remote_put( string $url, array $headers = array(), array $data = array(), array $options = array() ) 
{
	return App\Caller::put($url, $headers, $data, $options);
}