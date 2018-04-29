<?php
os_route( [ 'api', 'rest' ], 'os_restful' );
function os_restful()
{
	return array( 
		'generator' => 'Osen Restful API',
		'date'		=> date( 'Y-m-d' ),
		'time'		=> date( 'H:i:s' )
	);
}

os_route( [ 'api', 'users' ], 'os_api_users' );
function os_api_users( string $base = null, array $query = null )
{
	$users 			= new App\Data\Base( 'users' );

	if ( isset( $query[0] ) ) {
		if ( isset( $query[1] ) ) {
			$data 	= $users->fetch( array( $query[1] => $query[1] ) );
		} else {
			$data 	= $users->single( [ 'id' => $query[0] ]);
		}
	} else {          
		$data 		= $users->fetch();
	}
	
	return $data;
}

/**
 * ##################################################################
 *		ADD YOUR ROUTES HERE, IN THE FORM route( $route, $function, $args );
 * ##################################################################
*/

