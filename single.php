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

      /* This section is for categories and/or tags */
      echo ("<section>");
      echo "Categories: ";
      the_category(', ');
      echo "<br/>";
      the_tags('Tags: ', ' / ', '');
      echo ("</section>");

      if (have_posts()) :
        while (have_posts()) : the_post();
          # $content = substr(get_the_content(), 0, 100);
          # this gets the first 100 characters of the post
          # get_the_content returns a value, the_content() auto echos
          the_content();
        endwhile;
      endif;

      # comments template
      comments_template();

     ?>
	</div>
	<div class="col span_1_of_3">
    <?php get_sidebar(); ?>
	</div>

  <?php get_footer(); ?>
</div>
</body>
</html>
