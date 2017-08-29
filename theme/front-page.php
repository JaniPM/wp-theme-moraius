<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 */

get_header();
?>

<?php
// Get each of our active page-sections and show the post data.
if (get_active_sections_count() > 0 || is_customize_preview()) :
	$sections_per_page_count = apply_filters('sections_per_page_count', 4);

	// Create a setting and control for each of the sections available in the theme.
	for ($i = 1; $i <= $sections_per_page_count; $i++) {
		get_front_page_section($i);
	}

endif;
?>

<?php
get_footer();
?>
