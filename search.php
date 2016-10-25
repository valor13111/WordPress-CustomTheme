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
        echo '<a href="' . get_the_permalink() .'">' . get_the_title() . '</a><br/>';
        echo "Published on " . get_the_date() . "<br/>";
        $content = substr(strip_tags(get_the_content()), 0, 100) . '...';

        # Read More link
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
