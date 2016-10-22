<?php get_header(); ?>

<body>
  <h1><?php echo bloginfo('title'); ?></h1>
  <div class="section group">
	<div class="col span_1_of_3">
	This is column 1
	</div>
	<div class="col span_1_of_3">
	   <?php
      echo "<h2>"  .get_the_title() . "</h2>";
      echo "<h4>" . get_the_date() . "</h4>";

      # This section is for categories and/or tags
      # pages do not use categories or tags
      echo ("<section>");
      echo ("</section>");

      if (have_posts()) :
        while (have_posts()) : the_post();
          echo "Written by ";
          the_author();
          the_content();
        endwhile;
      endif;

      /*  This wasn't working on local host!!
      $posts = get_posts();
      foreach ($posts as $post) :
        setup_postdata($post);
        echo get_the_content();
      endforeach;
      */
     ?>
	</div>
	<div class="col span_1_of_3">
    <?php get_sidebar(); ?>
	</div>

  <?php get_footer(); ?>
</div>
</body>
</html>
