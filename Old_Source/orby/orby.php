<?php
/*
 Plugin Name: orby
Plugin URI: 
Description: 
Version: 0.9
Author:KAIBE Takahiro
*/
/***************************************************************
 * SECURITY : Exit if accessed directly
***************************************************************/
if ( !defined( 'ABSPATH' ) ) {
	die( 'Direct access not allowed!' );
}


add_shortcode( 'orby_chart_form', 'orby_chart_form');

function orby_chart_form() {
	// echo "<div style='height:300px;background-color:red;'>hogehoge</div>";
	// wp_register_style( 'bootstrap', plugins_url( 'bootstrap.min.css'), NULL, NULL);
	wp_enqueue_style( 'bootstrap', plugins_url( "bootstrap.min.css", __FILE__));
	// wp_enqueue_style( 'orby-style', plugins_url( "stylex.css", __FILE__ ) );
	wp_enqueue_script('google-maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyB8uqcA4bO2DQO2IRfqi8PCc__dtt4tnEA');
	wp_enqueue_script("jquery", plugins_url("js/jquery.min.js", __FILE__));
	wp_enqueue_script("jquery-validate", plugins_url("js/jquery.validate.min.js", __FILE__));

	// echo "<h2>horoscope</h2>";
	
	require_once (__DIR__."/natal_form_wheel.php");
}

add_action ('activated_plugin', 'orby_plugin_activated');
function orby_plugin_activated( $plugin, $network_activation) {

	// echo "<h1>plugin name = $plugin </h1><br/> \n";
	
	if ($plugin == 'orby/orby.php') {
		$perm = sprintf ("%04d", 755);
		chmod (__DIR__ . "/swetest", octdec($perm ));
	}
}


/***************************************************************
 * Custom Taxonomy
 ***************************************************************/

// require_once(plugin_dir_path( __FILE__ ) . '/oseblog-functions.php');
// require_once(plugin_dir_path( __FILE__ ) . '/login-style.php');
?>
