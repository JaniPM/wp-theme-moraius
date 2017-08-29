<?php

function theme_setup() {
	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support('title-tag');
}
add_action('after_setup_theme', 'theme_setup');

/**
 * Enqueue scripts and styles.
 */
function enqueue_styles_and_scripts() {

	wp_enqueue_style('bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
	wp_enqueue_style('animate', get_theme_file_uri('/css/animate.css'));
	wp_enqueue_style('et-line', get_theme_file_uri('/css/et-line.min.css'));
	wp_enqueue_style('font-awesome', get_theme_file_uri('/css/font-awesome.min.css'));

  // Theme's default font from google fonts
  wp_enqueue_style('font-montserrat', '//fonts.googleapis.com/css?family=Montserrat');

	// Theme main stylesheet.
	// Update version automatically after each file modification
 	$mainCssSrc = get_stylesheet_uri();
	$mainCssVer = filemtime( get_stylesheet_directory() . '/style.css');

	wp_enqueue_style('main_style', $mainCssSrc, array(), $mainCssVer);

  // JS includes
	wp_enqueue_script('bootstrap_js', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js');
	wp_enqueue_script('blocs', get_theme_file_uri('/js/blocs.js'), array('jquery'), '0.2', true);
}
add_action('wp_enqueue_scripts', 'enqueue_styles_and_scripts');

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * Customizer additions.
 */
require get_parent_theme_file_path( '/inc/customizer.php' );

?>
