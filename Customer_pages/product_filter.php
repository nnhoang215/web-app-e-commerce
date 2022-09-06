<?php
session_start();

function read_and_filter() {
  $file_name = 'products.csv';
  $fp = fopen($file_name, 'r');
  // first row => field names
  $first = fgetcsv($fp);
  $products = [];
  while ($row = fgetcsv($fp)) {
    $i = 0;
    $product = [];
    foreach ($first as $col_name) {
      $product[$col_name] =  $row[$i];
      // treat sizes differently
      // make it an array
      if ($col_name == 'sizes') {
        $product[$col_name] = explode(',', $product[$col_name]);
      }
      $i++;
    }
    if (isset($_GET['min_price']) && is_numeric($_GET['min_price'])) {
      if ($product['price'] < $_GET['min_price']) {
        continue;
      }
    }
    if (isset($_GET['max_price']) && is_numeric($_GET['max_price'])) {
      if ($product['price'] > $_GET['max_price']) {
        continue;
      }
    }
    if (isset($_GET['name']) && !empty($_GET['name'])) {
      if (strpos($product['name'], $_GET['name']) === false) {
        continue;
      }
    }
    if (isset($_GET['sizes']) && is_array($_GET['sizes'])) {
      $containAll = true;
      foreach ($_GET['sizes'] as $size) {
        if (!in_array($size, $product['sizes'])) {
          $containAll = false;
          break;
        }
      }
      if (!$containAll) {
        continue;
      }
    }
    $products[] = $product;
  }
  // overwrite the session variable
  $_SESSION['products'] = $products;
}

read_and_filter();

if (isset($_SESSION['products'])) {
  echo '<pre>';
  print_r($_SESSION['products']);
  echo '</pre>';
}

?>

<form method="get" action="product_filter.php">
  Min Price <input type="number" name="min_price"><br>
  Max Price <input type="number" name="max_price"><br>
  Name <input type="text" name="name"><br>
  Sizes <input type="checkbox" name="sizes[]" value="XS"> XS
    <input type="checkbox" name="sizes[]" value="S"> S
    <input type="checkbox" name="sizes[]" value="M"> M
    <input type="checkbox" name="sizes[]" value="L"> L
    <input type="checkbox" name="sizes[]" value="XL"> XL
  <br>
  <input type="submit" name="act" value="Filter">
</form>