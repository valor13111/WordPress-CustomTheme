<form class="searchform" action="<?php home_url('/') ?>" method="get">
  Search <input type="text" name="s" value = "<?php echo the_search_query() ?>" /><br/>

  <!-- This is to select from all categories in the site -->
  <select name="search_category">
    <option name='none'>Select A Category</option>
    <?php
      $categories = get_categories();
      foreach ($categories as $cat) {
        $val = $cat -> category_nickname;
        $name = $cat -> cat_name;
        $count = $cat -> category_count;
        print("<option value='$val'->$name($count)</option>");
      }
     ?>
   </select>

  <input type="submit" value="Search Something..." />
</form>
