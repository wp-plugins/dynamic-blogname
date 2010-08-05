<?php 
/*
Plugin Name: Dynamic Blogname
Plugin URI: http://andrewkiselev.com/dyn-blogname/
Description: Rotate blogname dynamicaly 
Version: 0.5
Author: kaaquantum
Author URI: http://andrewkiselev.com
License: GPL2
*/

//$file = plugins_url('dyn-blogname/titles.txt');
//$blogtitle = bloginfo('name');

function dyn_blogname_activation(){
	// create titles.txt
	$file = plugins_url('dyn-blogname/titles.txt');
	$content = bloginfo('name');	
	
	file_put_contents($file, $content, FILE_APPEND);
}

register_activation_hook( __FILE__, 'dyn_blogname_activation' );



// Return a random title read from a special file that contains a list of title to choose from.
function random_title(){
	
	$lines = file(plugins_url('dyn-blogname/titles.txt'), FILE_SKIP_EMPTY_LINES);        
	$title = $lines[array_rand($lines)];
	return $title;
}

add_filter('bloginfo', 'dyn_blogname', 1, 2);

// Filter for wordpress that redefines output of bloginfo('name')
function dyn_blogname($result='', $show='') {
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
