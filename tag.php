<?php get_header(); ?>

<body>
  <h1><?php echo bloginfo('title'); ?></h1>
  <div class="section group">
	<div class="col span_1_of_3">
	This is column 1
	</div>
	<div class="col span_1_of_3">

    <h1>Tag: <?php echo single_cat_title(); ?></h1>
     <!-- This displays all tags for corresponding tag selected, and all posts/pages with tags -->
	   <?php
      while ( have_posts() ) : the_post(); ?>
        <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
    <?php endwhile; ?>
	</div>
	<div class="col span_1_of_3">
    <?php get_sidebar(); ?>
	</div>

  <?php get_footer(); ?>
</div>
</body>
</html>
