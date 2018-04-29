<?php
/**
 * @package Osen Framework
 * @subpackage Admin Related Functions
 * @author Mauko Maunde < mauko@disruptiing.com >
 * @since 0.18.03
 * @version 1.04
 */

/**
 * Render Admin Pages
 * @param string $template Template file to load for page
 * @param array $data Information to pass to template
 */

function os_admin_url( $path = '' )
{
	echo getenv( 'home' ).'/admin/'.$path;
}

/**
 * Get app setting
 * @param string $option Code of setting to fetch
 * @param string $default Default value to use if option does not exist
 * @return mixed/string
 */
function os_option( $option, $default = '' )
{
	$record = $GLOBALS['OPTIONS']->fetch( [ 'code' => $option ] );
	return $option = isset( $record['error'] ) ? $default : $record['details'];
}

/**
 * Output app setting
 * @param string $option Code of setting to fetch
 * @param string $default Default value to use if option does not exist
 */
function os_show_option( $option, $default = '' )
{
	$record = $GLOBALS['OPTIONS']->fetch( [ 'code' => $option ] );
	echo $option = isset( $record['error'] ) ? $default : $record['details'];
}

/**
 * Login existing user
 */
function os_login( $data = null )
{
	if ( isset( $_POST['login'] ) ) {
		$user 		= trim( $_POST['user'] );
		$pass 		= trim( $_POST['password'] );

		$the_user 	= filter_var( $user, FILTER_VALIDATE_EMAIL ) ? $GLOBALS['USERS']->single( [ 'email' => $user ] ) : $GLOBALS['USERS']->single( [ 'username' => $user ] );
		if( isset( $the_user['error'] ) ){
			os_redirect( 'login/?error=user' );
		} else {
			if ( password_verify( $pass, $the_user['password'] ) ) {
				$_SESSION['safiri_user_title'] 		= $the_user['title'];
				$_SESSION['safiri_user_username'] 	= $the_user['username'];
				$_SESSION['safiri_user_id'] 		= $the_user['id'];
				$_SESSION['safiri_user_type'] 		= $the_user['type'];
				$_SESSION['safiri_user_email'] 		= $the_user['email'];
				$_SESSION['safiri_user_avatar'] 	= $the_user['avatar'];

				if ( in_array( $the_user['type'], [ 'accountant', 'agent', 'editor' ] ) ) {
					os_redirect( 'dashboard' );
				} else {
					os_redirect( 'admin' );
				}

			} else {
				os_redirect( 'login/?error=password' );
			}
		}
	}
}

/**
 * Register new user
 */
os_route( 'register', 'os_register', 'register' );
function os_register( $data = null )
{
	if( isset( $_POST['register'] ) ){
		$posted 	= array();
		$values 	= array();
		$columns 	= array();

		$users 		= new App\Data\Base( 'users' );

		foreach ( $users->columns as $column ) {
			if ( isset( $_POST[$column] ) ) {
				$posted[$column] = trim( $_POST[$column] );
			} else {
				$posted[$column] = '';
			}
		}

		$posted['password'] = password_hash( trim( $_POST['password'] ), PASSWORD_DEFAULT );
	    $posted['created'] 	= date( 'Y-m-d H:i:s' );
	    $posted['updated'] 	= date( 'Y-m-d H:i:s' );
	    $posted['type'] 	= 'rep';
	    $posted['location'] = 'Nairobi';
	    $posted['avatar']   = getenv('home').'/app/assets/img/user.jpg';
	    $posted['authkey']	= strtoupper( substr( md5( date( 'Y-m-d H:i:s' ) ), 0, 6 ) );

	    unset( $posted['id'] );

		foreach ( $posted as $column => $value ) {
			$values[] 		= $value;
			$columns[] 		= $column;
		}

		if ( $users->insert( $values, $columns, $record ) ){
			return array( 'login' );
		} else {
			//os_redirect( 'register/?error=create' );
			return array( $users->error() );
		}
	}
}

/**
 * Confirm user registration via email
 * @param int $id Numeric ID of user
 * @param mixed/string $key One-time key to authenticate request
 */
function os_confirm( $data = null )
{
	if( isset( $_GET['confirm'] ) ){
		$user = $GLOBALS['USERS']->single( [ 'id' => $_GET['id'], 'key' => $_GET['key'] ] );
		if ( isset( $user['error'] ) ) {
			os_redirect( 'confirm/?error=key' );
		} else {
			os_redirect( 'login/?confirm=success' );
		}
	} else {
		require_once( _APP_.'templates/admin/head.php' );
		os_admin( 'confirm', $data  );
	}
}

/**
 * Render forgot password form
 */
function os_forgot( $data )
{
	require_once( _APP_.'templates/admin/head.php' );
	os_admin( 'forgot', $data  );
}

/**
 * Render password recovery form
 * @param int $id Numeric ID of user
 * @param mixed/string $key One-time key to authenticate request
 */
function os_recover( $id, $key )
{
	$user = $GLOBALS['USERS']->single( [ 'id' => $id, 'key' => $key ] );
	if ( isset( $user['error'] ) ) {
		os_redirect( 'recover/?error=key' );
	} else {
		os_redirect( 'login/?recover=success' );
	}
 
	require_once( _APP_.'templates/admin/head.php' );
	os_admin( 'recover' );
}

/**
 * ##################################################################
 *		ADD YOUR ADMIN FUNCTIONS HERE, IN THE FORM my_function( $args );
 * ##################################################################
*/
os_route( ['admin', 'parking'], 'os_admin_parking', 'parking' );
function os_admin_parking( string $zone = null)
{
	return array();
}