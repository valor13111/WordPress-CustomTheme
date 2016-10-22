<!-- can be used for wordpress hooks, or actual php functions -->

<?php

function the_current_year() {
  $this_year = Date('Y');

  return $this_year;
}

?>
