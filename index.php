<?php get_header(); ?>

<body>
<?php
  wp_nav_menu(
    array(
      'theme_location'  => 'header_menu',
      'fallback_cb'     => false,
      'before'          => '=>',
      'after'           => ' | ',
      'container'       => 'div',
      'container_id'    => 'header_parent',
      'container_class' => 'header_menus'
    )
  );

  echo $header_menu;
?>

  <div class="section group">
	<div class="col span_1_of_3">
    <?php

      if(has_nav_menu('left_sidebar')) {
        wp_nav_menu(
          array(
            'theme_location'      =>  'left_sidebar',
            'menu_id'             =>  'left-sidebar-menu',
            'menu_class'          =>  'left-sidebar-menus',
            'fallback_cb'         =>  false
          )
        );
      } else {
        "Sorry, but sidebar DNE.";
      }

    ?>
	</div>
	<div class="col span_1_of_3">
	   <?php
    echo "<h2> Posts </h2>";

    # ---- array of posts
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

     echo "<h2> Custom Post Type </h2>";

     # ---- array of pages
     $args = array(
       'posts_per_page' => 3,
       'post_type' => array('Custom Post Type')
     );
     $post_data = get_posts($args);

     foreach ($post_data as $post) {
       $link = get_permalink();
       echo '<h3><a href="' . $link . '">' . get_the_title() . '</a></h3>';
       echo "Published on " . get_the_date() . '<br/>';
     }

     echo "<h2> Pages </h2>";

     # ---- array of posts
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
