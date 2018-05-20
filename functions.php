<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;


/**
 * Copyright
 */
function custom_get_copyright() {
	echo '© ' .  date('Y') . ' ' . get_bloginfo('name') . '. Todos los derechos reservados.';
}


/**
 * Styles and scripts
 */
 
function custom_styles_scripts() {
    wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array(  ) );
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Poppins:400,400i,700,700i');
}
add_action( 'wp_enqueue_scripts', 'custom_styles_scripts', 10 );


/**
 * Remove WordPress Logo From Admin Bar
 */

function annointed_admin_bar_remove() {
        global $wp_admin_bar;
        $wp_admin_bar->remove_menu('wp-logo');
}
add_action('wp_before_admin_bar_render', 'annointed_admin_bar_remove', 0);


/**
 * Remove customizer sections
 * 
 */
 
function jpjuliao_customize_register( $wp_customize ){
	$wp_customize->remove_section( 'colors' );
	//$wp_customize->remove_section( 'header_image' );
	$wp_customize->remove_section( 'theme_options' );
	$wp_customize->remove_section( 'static_front_page' );
	$wp_customize->remove_section( 'custom_css' );
}
add_action( 'customize_register', 'jpjuliao_customize_register', 11 );


/**
 * Search only post type
 */
if (!is_admin()) {
	function custom_search_filter($query) {
		if ($query->is_search) {
			$query->set('post_type', array('post'));
		}
		return $query;
	}
	add_filter('pre_get_posts','custom_search_filter');
}
