<?php
function os_home_url( $path = '' )
{
	echo getenv( 'home' ).'/'.$path;
}

os_route( 'page', 'os_page', 'page' );
function os_page( $slug, $rest = null )
{
	$posts 		= new App\Data\Base('posts');

	$template   = file_exists( THEMES."{$theme}/public/page.tpl" ) ? THEMES."{$theme}/public/page.tpl" : THEMES."default/public/page.tpl";
    $data 		= is_null( $rest ) ? $posts -> fetch( [ 'slug' => $slug ] ) : $posts -> fetch();

	if ( isset( $posts['error'] ) ) {
		$template   = file_exists( THEMES."{$theme}/public/404.tpl" ) ? THEMES."{$theme}/public/404.tpl" : THEMES."default/public/404.tpl";
        $data       = ["error" => "No route set for '{$base}'"];
	}
	echo $dwoo->get( $template, [ 'records' => $data, 'system' => $_ENV, 'session' => $_SESSION, 'request' => getenv('home')."/{$base}" ] );
}

os_route( 'blog', 'os_blog', 'blog' );
function os_blog( $query = null )
{
	$users = new App\Data\Base('posts');
	return $users -> fetch();
}

/**
 * ##################################################################
 *		ADD YOUR FRONT FUNCTIONS HERE, IN THE FORM my_function( $args );
 * ##################################################################
*/

