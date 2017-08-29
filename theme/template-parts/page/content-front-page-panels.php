<?php
/**
 * Template part for displaying pages on front page
 */

global $section_index;
?>

<div id="section-<?php echo $section_index; ?>" class="<?php echo get_section_classes($section_index); ?>">
  <div class="<?php echo get_container_classes($section_index); ?>">
    <?php the_content(); ?>
  </div>
</div>
