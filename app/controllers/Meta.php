<?php
namespace App;
/**
* 
*/
class Meta
{
    public static $metadata = array();
    
    private function __construct(){}
    
    public static function add( $name, $content, $id = null )
    {
        self::$metadata[] = array( 'name' => $name, 'content' => $content );
    }

    public static function show()
    {
        foreach( self::$metadata as $meta => $data ) {
            echo( '<meta name="'.$data['name'].'" content="'.$data['content'].'" id="meta'.$meta.'" >' );
        }
    }
}