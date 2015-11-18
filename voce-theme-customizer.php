<?php
/*
  Plugin Name: Voce Theme Customizer
  Plugin URI: http://plugins.voceconnect.com
  Description: Theme Customizer
  Version: 1.2.1
  Author: banderon, csloisel, jeffstieler, kevinlangleyjr
  License: GPL2
 */

if( defined('ABSPATH') && !function_exists( 'voce_theme_customizer_init' ) ) {
	function voce_theme_customizer_init(){
		if( class_exists( 'WP_Customize_Control' ) ) {
			$files = glob( __DIR__ . '/controls/*.php' );
			foreach( $files as $file ){
				$class = basename( $file );

				if( ! class_exists( $class ) && 0 === validate_file( $file ) ) {
					require_once $file;
				}
			}

			Voce_Customize_Image_Control::init();
			Voce_Customize_PSU_Control::init();
		}
	}

	add_action( 'init', 'voce_theme_customizer_init' );
}
