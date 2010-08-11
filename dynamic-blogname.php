<?php 
/*
Plugin Name: Dynamic Blogname
Plugin URI: http://andrewkiselev.com/projects/dynamic-blogname/
Description: Change blogname dynamicaly 
Version: 2.0
Author: kaaquantum
Author URI: http://andrewkiselev.com
License: GPL2
*/

include(dirname(__FILE__).'/options.php');


// Actiovation action
function dynamic_blogname_activation(){
	add_option('o_db_list', get_bloginfo( 'name' ));	
}

register_activation_hook( __FILE__, 'dynamic_blogname_activation' );

// Return a random title read from a special file that contains a list of title to choose from.
function random_title(){
		
	$lines = explode("\n", get_option('o_db_list'));

	return $lines[array_rand($lines)];
}


add_filter('bloginfo', 'dynamic_blogname', 1, 2);

// Filter for wordpress that redefines output of bloginfo('name')
function dynamic_blogname($result='', $show='') {
	
	switch ($show) {
		case 'name':
			$result = random_title();
			break;
		default: 
		//	$result = get_bloginfo($show, 'display');
	}
	return $result;
}
?>
