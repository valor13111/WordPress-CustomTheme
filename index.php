<?php get_header(); ?>

<body>
  <h1><?php echo bloginfo('title'); ?></h1>
  <div class="section group">
	<div class="col span_1_of_3">
	This is column 1
	</div>
	<div class="col span_1_of_3">
	   <?php
    echo "<h2> Posts </h2>";

    # array of posts
     $args = array(
       'posts_per_page' => 3,
       'post_type' => 'post'
     );
     $post_data = get_posts($args);

     foreach ($post_data as $post) {
       $link = get_permalink();
       echo '<h3><a href="' . $link . '">' . get_the_title() . '</a></h3>';
       echo "Published on " . get_the_date() . '<br/>';
     }

     echo "<h2> Pages </h2>";

     # array of pages
     $args = array(
       'posts_per_page' => 3,
       'post_type' => 'page'
     );
     $post_data = get_posts($args);

     foreach ($post_data as $post) {
       $link = get_permalink();
       echo '<h3><a href="' . $link . '">' . get_the_title() . '</a></h3>';
       echo "Published on " . get_the_date() . '<br/>';
     }
     ?>
	</div>
	<div class="col span_1_of_3">
    <?php get_sidebar(); ?>
	</div>

  <?php get_footer(); ?>
</div>
</body>
</html>
