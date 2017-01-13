<?php wp_footer(); ?>


<footer>

<?php
  wp_nav_menu(
    array(
      'theme_location'    => 'footer_menu',
      'fallback_cb'       => false,
      'menu_id'           => 'footer-menu',
      'menu_class'        => 'footer-menus',
      'after'             => ' | '
    )
  );
?>

  &copy; <?php echo the_current_year(); ?> Designed By Tyler Reed

</footer>
