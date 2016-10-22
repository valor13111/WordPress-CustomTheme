<?php

/*
 * Template Name: Full Width - No Sidebars
 */

get_header();
?>

<body>
  <h1><?php echo bloginfo('title'); ?></h1>
  <div class="section group">
	<div class="col span_3_of_3">
	   <?php
      echo "<h2>"  .get_the_title() . "</h2>";
      echo "<h4>" . get_the_date() . "</h4>";
      
      if (have_posts()) :
        while (have_posts()) : the_post();
          echo "Written by ";
          the_author();
          the_content();
        endwhile;
      endif;
     ?>
	</div>

  <?php get_footer(); ?>
</div>
</body>
</html>
