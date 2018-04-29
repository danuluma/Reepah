<?php

function os_send_json( $array = array() )
{
	header( "Content-type: Application/json" );
    echo json_encode( $array );
}

function os_add_meta( $name, $content, $id = null )
{
    return App\Meta::add( $name, $content, $id );
}

function os_meta()
{
    return App\Meta::show();
}

function os_style( $stylesheet, $base = '', $extra = null )
{
	return App\Styles::add( $stylesheet, $base, $extra );
}

function os_script( $script, $base = '', $extra = null )
{
	return App\Scripts::add( $script, $base, $extra );
}

function os_styles()
{
	return App\Styles::show();
}

function os_scripts( $location = 'footer' )
{
	return App\Scripts::show( $location );
}

function os_image( $image, $width = '100%', $height = '', $alt = 'Image', $class = '' )
{
	if ( is_array( $image ) ) {
		$path = getenv( 'home' ).'/app/assets/img/'.$image[0];
	}
	return '<img src="'.$path.'" width="'.$width.'" height="'.$height.'" alt="'.$alt.'" class="'.$class.'">';
}

function os_image_url( $image, $local = true )
{
	$path = ( $local == true ) ? getenv( 'home' ).'/app/assets/img/' : ''; 
	echo $path.$image;
}

/**
 * ##################################################################
 *		ADD YOUR MISCELLENOUS FUNCTIONS HERE, IN THE FORM my_function( $args );
 * ##################################################################
*/

