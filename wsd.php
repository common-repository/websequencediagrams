<?php
/*
Plugin Name: WebSequenceDiagrams
Plugin URI: http://joel.vandal.ca/
Description: Add support for WebSequenceDiagrams.com.
Version: 1.0
Author: Joel Vandal
Author URI: http://joel.vandal.ca/
*/

/*  Copyright 2012 Joel Vandal  (email : joel[at]scopserv[dot]com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

define ('WSD_FULL',ABSPATH."wp-content/plugins/wsd/");
define ('WSD',get_bloginfo('wpurl')."/wp-content/plugins/wsd/");

register_activation_hook(__FILE__, 'wsd_add_options');
register_deactivation_hook(__FILE__, 'wsd_delete_options');

add_filter('mce_external_plugins', 'wsd_register');

add_shortcode('wsd', 'wsd_diagram_function');

function wsd_add_options() {
    add_option('wsd_diagram', '1', '', 'yes');
}

function wsd_delete_options() {
    delete_option('wsd_diagram');
}

function wsd_register($plugin_array) {
    
    if(get_option('wsd_diagram') == 1) {
	$url = trim(get_bloginfo('url'), "/")."/wp-content/plugins/wsd/editor.js";
	$plugin_array['wsd_diagram'] = $url;
	add_filter('mce_buttons', 'wsd_add_diagram_button', 0);
    }
    
    return $plugin_array;
}

function wsd_add_diagram_button($buttons) {
    array_push($buttons, "separator", "wsd_diagram");
    return $buttons;
}

function wsd_diagram_function($attr, $content = null) {
    $theme = isset($attr['theme']) ? $attr['theme'] : 'modern-blue';
    $content = html_entity_decode($content);
    return '<div class=wsd wsd_style="' . $theme . '">' . $content . '</div><script type="text/javascript" src="http://www.websequencediagrams.com/service.js"></script>';
}
