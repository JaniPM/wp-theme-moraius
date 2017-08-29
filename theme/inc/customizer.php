<?php

/**
 * WordPress Customizer setup
 */
function register_customizer($wp_customize) {

	// Header options for Moriaus
	$wp_customize->add_section('header_options', array(
		'title'    => 'Moraius Header Options',
		'priority' => 129, // Before Additional CSS.
	));
	add_header_content_setting($wp_customize);

	// Theme options for Moraius.
	$wp_customize->add_section('theme_options', array(
		'title'    => 'Moraius Theme Options',
		'priority' => 130, // Before Additional CSS.
	));

	$sections_per_page_count = apply_filters('sections_per_page_count', 4);

	// Create a setting and controls for each of the page sections
	for ($i = 1; $i <= ($sections_per_page_count); $i++) {
		add_section_content_setting($wp_customize, $i);
		add_colorscheme_setting($wp_customize, $i);
		add_section_size_setting($wp_customize, $i);
	}
}
add_action('customize_register', 'register_customizer');

function add_header_content_setting($wp_customize) {
	$setting_id = 'header_content';

	$wp_customize->add_setting($setting_id, array(
		'default'           => false,
		'sanitize_callback' => 'absint',
		'transport'         => 'refresh'
	));

	$wp_customize->add_control($setting_id, array(
		'label'          => 'Select page for header part',
		'section'        => 'header_options',
		'type'           => 'dropdown-pages',
		'allow_addition' => false, // Don't allow adding new pages from control
		'active_callback' => 'moraius_is_static_front_page'
	));
}

function add_section_content_setting($wp_customize, $section_index) {
	$setting_id = 'section_content_' . $section_index;

	$wp_customize->add_setting($setting_id, array(
		'default'           => false,
		'sanitize_callback' => 'absint',
		'transport'         => 'refresh'
	));

	$wp_customize->add_control($setting_id, array(
		'label'          => 'Select page for section',
		'section'        => 'theme_options',
		'type'           => 'dropdown-pages',
		'allow_addition' => false, // Don't allow adding new pages from control
		'active_callback' => 'moraius_is_static_front_page'
	));
}

function add_colorscheme_setting($wp_customize, $section_index) {
	$setting_id = 'section_colorscheme_' . $section_index;

	$wp_customize->add_setting($setting_id, array(
		'default'           => 'light',
		'sanitize_callback' => 'sanitize_choices',
		'transport'         => 'refresh'
	));

	$wp_customize->add_control($setting_id, array(
		'label'          => 'Select style for section',
		'section'        => 'theme_options',
		'type'           => 'select',
		'choices'				 => array(
			'dark' 				=> 'Dark',
			'light'			  => 'Light',
			'medium-dark' => 'Medium-Dark'
		),
		'active_callback' => 'moraius_is_static_front_page'
	));
}

function add_section_size_setting($wp_customize, $section_index) {
	$setting_id = 'section_size_' . $section_index;

	$wp_customize->add_setting($setting_id, array(
		'default'           => 'container_size_lg',
		'sanitize_callback' => 'sanitize_choices',
		'transport'         => 'refresh'
	));

	$wp_customize->add_control($setting_id, array(
		'label'          => 'Select section size',
		'section'        => 'theme_options',
		'type'           => 'select',
		'choices'				 => array(
			'container_size_xl' => 'X-Large',
			'container_size_lg' => 'Large',
			'container_size_md' => 'Medium',
			'container_size_sm' => 'Small'
		),
		'active_callback' => 'moraius_is_static_front_page'
	));
}

function sanitize_choices($input, $setting) {
	// Get list of choices from the control associated with the setting.
  $choices = $setting->manager->get_control($setting->id)->choices;

  // If the input is a valid key, return it; otherwise, return the default.
  return (array_key_exists($input, $choices) ? $input : $setting->default);
}

function moraius_is_static_front_page() {
	return (is_front_page() && ! is_home());
}

function get_active_sections_count() {
	$sections_per_page_count = apply_filters('sections_per_page_count', 4);
	$active_count = 0;

	// Create a setting and control for each of the sections available in the theme.
	for ($i = 1; $i <= ($sections_per_page_count); $i++) {
		if (get_theme_mod('section_content_' . $i)) {
			$active_count++;
		}
	}

	return $active_count;
}

?>
