<?php
/*
Plugin Name: Readability Buttons (readability.com)
Plugin URI: http://sparanoid.com/lab/readability-widget/
Description: Add readability.com widget for your site.
Version: 2.0.1
Author: Tunghsiao Liu
Author URI: http://sparanoid.com/
Author Email: info@sparanoid.com
License: GPLv2 or later

  Copyright 2012 Tunghsiao Liu, aka. Sparanoid (info@sparanoid.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as 
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

class Readability_Widget extends WP_Widget {

	/*--------------------------------------------------*/
	/* Constructor
	/*--------------------------------------------------*/
	
	/**
	 * The widget constructor. Specifies the classname and description, instantiates
	 * the widget, loads localization files, and includes necessary scripts and
	 * styles.
	 */
  	// TODO: This should match the title given in the class definition above.
	public function __construct() {
	
		load_plugin_textdomain( 'readability_buttons', false, plugin_dir_path( __FILE__ ) . '/lang/' );
		
		register_activation_hook( __FILE__, array( &$this, 'activate' ) );
		register_deactivation_hook( __FILE__, array( &$this, 'deactivate' ) );
		
		// TODO: update classname and description
    	// TODO: replace 'plugin-name-locale' to be named more plugin specific. other instances exist throughout the code, too.
		parent::__construct(
			'widget-readability-buttons-id',
			'Readability Buttons',
			array(
				'classname'		=>	'widget-readability-buttons',
				'description'	=>	__( 'Short description.', 'plugin-name-locale' )
			)
		);
		
		// Load JavaScript and stylesheets
		$this->register_scripts_and_styles();
	
	} // end constructor

	/*--------------------------------------------------*/
	/* Widget API Functions
	/*--------------------------------------------------*/
	
	/**
	 * Outputs the content of the widget.
	 *
	 * @args			The array of form elements
	 * @instance		The current instance of the widget
	 */
	function widget( $args, $instance ) {
	
		extract( $args, EXTR_SKIP );
    $title 		           = apply_filters('widget_title', $instance['title']);
    $show_read           = $instance['show_read'];
    $show_print          = $instance['show_print'];
    $show_email          = $instance['show_email'];
    $show_send_to_kindle = $instance['show_send_to_kindle'];
    $show_vertical       = $instance['show_vertical'];
    $text_color          = $instance['text_color'];
    $bg_color            = $instance['bg_color'];
		
		echo $before_widget;
		
    	// TODO: This is where you retrieve the widget values
    
		// Display the widget
		include( plugin_dir_path(__FILE__) . '/views/widget.php' );
		
		echo $after_widget;
		
	} // end widget
	
	/**
	 * Processes the widget's options to be saved.
	 *
	 * @new_instance	The previous instance of values before the update.
	 * @old_instance	The new instance of values to be generated via the update.
	 */
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		
    	// TODO Update the widget with the new values
  		$instance['title']               = strip_tags($new_instance['title']);
  		$instance['show_read']           = strip_tags($new_instance['show_read']);
  		$instance['show_print']          = strip_tags($new_instance['show_print']);
  		$instance['show_email']          = strip_tags($new_instance['show_email']);
  		$instance['show_send_to_kindle'] = strip_tags($new_instance['show_send_to_kindle']);
  		$instance['show_vertical']       = strip_tags($new_instance['show_vertical']);
  		$instance['text_color']          = strip_tags($new_instance['text_color']);
  		$instance['bg_color']            = strip_tags($new_instance['bg_color']);
    
		return $instance;
		
	} // end widget
	
	/**
	 * Generates the administration form for the widget.
	 *
	 * @instance	The array of keys and values for the widget.
	 */
	function form( $instance ) {
	
    	// TODO define default values for your variables
		//$instance = wp_parse_args(
		//	(array) $instance,
		//	array(
		//		'$title'	=>	'wwwwwww'
		//		'$$message'	=>	'aaaaaaa'
		//	)
		//);
    
    $title                = esc_attr($instance['title']);
    $show_read            = esc_attr($instance['show_read']);
    $show_print           = esc_attr($instance['show_print']);
    $show_email           = esc_attr($instance['show_email']);
    $show_send_to_kindle  = esc_attr($instance['show_send_to_kindle']);
    $show_vertical        = esc_attr($instance['show_vertical']);
    $text_color           = esc_attr($instance['text_color']);
    $bg_color             = esc_attr($instance['bg_color']);
    
	
    	// TODO store the values of widget in a variable
		
		// Display the admin form
    	include( plugin_dir_path(__FILE__) . '/views/admin.php' );
		
	} // end form
	
	/*--------------------------------------------------*/
	/* Public Functions
	/*--------------------------------------------------*/
	
	/**
	 * Fired when the plugin is activated.
	 *
	 * @params	$network_wide	True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog 
	 */
	function activate( $network_wide ) {
		// TODO define activation functionality here
	} // end activate
	
	/**
	 * Fired when the plugin is deactivated.
	 *
	 * @params	$network_wide	True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog 
	 */
	function deactivate( $network_wide ) {
		// TODO define deactivation functionality here		
	} // end deactivate
	
	/*--------------------------------------------------*/
	/* Private Functions
	/*--------------------------------------------------*/
  
	/**
	 * Registers and enqueues stylesheets for the administration panel and the
	 * public facing site.
	 */
	private function register_scripts_and_styles() {
	
		if ( is_admin() ) {
		
			// TODO remember to rename 'widget-slug-' to the name of the widget
			$this->load_file( 'widget-slug-admin-script', '/js/admin.js', true );
			$this->load_file( 'widget-slug-admin-style', '/css/admin.css' );
			
		} else { 
		
			// TODO remember to rename 'widget-slug-' to the name of the widget
			$this->load_file( 'widget-slug-script', '/js/widget.js', true );
			$this->load_file( 'widget-slug-style', '/css/widget.css' );
			
		} // end if/else
		
	} // end register_scripts_and_styles

	/**
	 * Helper function for registering and enqueueing scripts and styles.
	 *
	 * @name	The 	ID to register with WordPress
	 * @file_path		The path to the actual file
	 * @is_script		Optional argument for if the incoming file_path is a JavaScript source file.
	 */
	private function load_file( $name, $file_path, $is_script = false ) {
		
		$url = plugins_url( $file_path, __FILE__ ) ;
		$file = plugin_dir_path( __FILE__ ) . $file_path;

		if( file_exists( $file ) ) {
		
			if( $is_script ) {
			
				wp_register_script( $name, $url, array( 'jquery' ) );
				wp_enqueue_script( $name );
				
			} else {
			
				wp_register_style( $name, $url );
				wp_enqueue_style( $name );
				
			} // end if
			
		} // end if
    
	} // end load_file
	
} // end class
// TODO remember to change 'Readability_Widget' to match the class name definition
add_action( 'widgets_init', create_function( '', 'register_widget("Readability_Widget");' ) ); 
?>