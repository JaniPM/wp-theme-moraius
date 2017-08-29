<?php
function get_header_section() {
	$page_mod = get_theme_mod('header_content');

	if ($page_mod) {
		global $post;
		$post = get_post($page_mod);

		setup_postdata($post);

		get_template_part('template-parts/page/content', 'header');

		wp_reset_postdata();
	}
}

function get_front_page_section($id = 0) {
	// Get page selector setting by setting id set in customizer.php.
	// Default value is false, meaning no page were selected.
	$page_mod = get_theme_mod('section_content_' . $id);

	if ($page_mod) {
		// Setup current page section index
		// Page contect uses it for rendering id of the dom elementes
		global $section_index;
		$section_index = $id;

    // Setup post data (page content) and add page as section to front page
		global $post;
		$post = get_post($page_mod);

		setup_postdata($post);

		// Place page-secton from separate template file
		get_template_part('template-parts/page/content', 'front-page-panels');

		wp_reset_postdata();
	} elseif (is_customize_preview()) {
		// In the preview mode we just output placeholder anchor.
		echo '<div class="section section__placeholder" id="section-' . $id . '"><span class="panel-title">' . sprintf('Front Page Section %1$s Placeholder', $id ) . '</span></div>';
	}
}

function create_navitem($id = 0) {
	$navlink = "";
	$page_mod = get_theme_mod('section_content_' . $id);

	if ($page_mod) {
		$post = get_post($page_mod);
		$title = $post->post_title;

		$navlink = "<li><a onclick=\"scrollToTarget('#section-" . $id . "')\">" . $title . "</a></li>";
	}

	echo $navlink;
}

function get_section_classes($id = 0) {
	$colorscheme_mod = get_theme_mod('section_colorscheme_' . $id);
	$classes = 'section section_' . $colorscheme_mod;

	return $classes;
}

function get_container_classes($id = 0) {
	$size_mod = get_theme_mod('section_size_' . $id);
	$classes = 'container container_size_' . $size_mod;

	return $classes;
}
?>
