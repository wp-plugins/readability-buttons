<?php
/*
Plugin Name: Readability Widget (readability.com)
Plugin URI: http://nio2.com/resources/readability-buttons/
Description: Add readability.com button on your sidebar.
Version: 1.0
Author: Sparanoid
Author URI: http://sparanoid.com/
License: GPLv2 or later
*/


add_action('widgets_init', array('readability_widget', 'register'));
class readability_widget {
/*
	function control(){
		echo 'No options.';
	}
*/

	function widget($args){
		echo $args['before_widget'];
		echo '<div id=rdbWrapper></div>';
		echo '<script type=text/javascript>(function(){var s=document.getElementsByTagName(\'script\')[0],rdb=document.createElement(\'script\');rdb.type=\'text/javascript\';rdb.async=true;rdb.src=document.location.protocol+\'//www.readability.com/embed.js\';s.parentNode.insertBefore(rdb,s)})();</script>';
		echo $args['after_widget'];
	}

	function register(){
		register_sidebar_widget('readability.com', array('readability_widget', 'widget'));
/* 		register_widget_control('readabilaity.com', array('readability_widget', 'control')); */
	}
}

?>