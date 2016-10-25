<?php get_header(); ?>

<body>
  <h1><?php echo bloginfo('title'); ?></h1>
  <div class="section group">

  <div class="col span_1_of_3">
    This is column 1
  </div>

	<div class="col span_2_of_3">
	   <?php
      echo "<h2> Searched Results: " . get_search_query() . " </h2>";

      while(have_posts()) : the_post();
        /* gets the thumbnail for the post and displays it */
        echo get_the_post_thumbnail(get_the_ID(), medium) . '</br>';
        /* gets the title and anchors it */
        echo '<a href="' . get_the_permalink() .'">' . get_the_title() . '</a><br/>';
        /* gets the author/published date for the post */
        echo "Published by " . get_the_author() . "(" . get_the_author_posts() . ")<br/>";
        echo "Published on " . get_the_date() . "<br/>";
        /* only allows the first 100 characters to be displayed from the post */
        $content = substr(strip_tags(get_the_content()), 0, 100) . '...';

        /* Read More link */
        echo $content;
        echo '<a href="' . get_the_permalink() . '">Read More</a><br/>';
        echo '<hr/>';
      endwhile;
     ?>
	</div>

  <?php get_footer(); ?>
</div>
</body>
</html>
