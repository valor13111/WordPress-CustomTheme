<!-- can be used for wordpress hooks, or actual php functions -->

<?php

add_theme_support('post-thumbnails');

function the_current_year() {
  $this_year = Date('Y');

  return $this_year;
}

?>
