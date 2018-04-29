<?php
namespace App;
/**
* 
*/
class Scripts
{
    public static $menus = array();
    
    private function __construct(){}
    
    public static function add( $menu, $base = '', $title = '', $location = 'drawer', $icon = 'label' )
    {
        self::$menus[$location][] = $baseurl.$menu;
    }

    public static function menu( $base )
    {
        foreach( self::$menus[$base] as $menu ) {
            echo $menu = '<a class="mdl-navigation__link text-white" href="#" id="customers">
                <i class="material-icons" role="presentation">group</i>
                Customers <span class="material-icons right">keyboard_arrow_down</span>
            </a>';
        }
    }

    public static function submenu( $base )
    {
        foreach( self::$menus[$base] as $menu ) {
            echo $menu = '<ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-js-ripple-effect mdl-list primary" for="customers">
                    <a class="mdl-navigation__link text-blue" href="#" id="tickets">
                        <i class="material-icons" role="presentation">label</i>
                        Customers
                    </a>
                    <a class="mdl-navigation__link text-white" href="#" id="tickets">
                        <i class="material-icons" role="presentation">star</i>
                        Top
                    </a>
                </ul>';
        }
    }
}