<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="description" content="<?php bloginfo('description'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
  <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
  <?php wp_head(); ?>
</head>
<body>
<!-- Main container -->
<div class="page-container">

  <!-- Navigation Bloc -->
  <div class="section section_dark" id="nav-section">
    <div class="container">
      <nav class="navbar row">
        <div class="navbar-header">
          <a class="navbar-brand" href="index.php"></a>
          <button id="nav-toggle"
                  type="button"
                  class="ui-navbar-toggle navbar-toggle"
                  data-toggle="collapse"
                  data-target=".navbar-1">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
          </button>
        </div>

        <div class="collapse navbar-collapse">
          <ul class="site-navigation nav navbar-nav">
          <?php
            $section_count = get_active_sections_count();

            for($i = 1; $i <= $section_count; $i++) {
              create_navitem($i);
            }
          ?>
          </ul>
        </div>

      </nav>
    </div>
  </div>
    <!-- Navigation Bloc END -->

    <!-- header -->
    <?php
    get_header_section();
    ?>
    <!-- header END -->
