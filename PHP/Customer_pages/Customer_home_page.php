<?php
session_start();
?>
 
<!DOCTYPE html>

<html>
    <head>
        <?php require '../php_scripts/general_head.php'?>
    </head>
    <body>
        <header>
            <nav>
                <div class="nav-bar">
                <div class="logo-name">
                    <a href="../../index.php"><img src="../img/shopee_logo.png" alt="logo"></a>
                    <p><a href="../../index.php">The world's biggest E-commerce application</a></p>
                </div>
                    <form method="get" action="Customer_home_page.php">
                    <div class="search-bar">
                        <input type="text" name="name" placeholder="  Search..." id="search-text">
                        <button type="submit" name="act" id="search"><i class="fa fa-search"></i></button>
                    </div>
                    </form>
                    <div class="nav">
                        <ul>
                            <?php 
                                $_redirectLink = isset($_SESSION["current_user"]) ? "../Myaccount/Myaccount.php" : "../index.php";
                                echo '<li><a href="'.$_redirectLink.'">My Account</a></li>';
                                $_login = isset($_SESSION["current_user"])
                                    ? "Welcome, ".$_SESSION['current_user']['username'] 
                                    : "<li><a href=".$_redirectLink.">Log in</a></li>";
                                echo ''.$_login.'';
                            ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <section class="customer-home-pages">
            <form method="get" action="Customer_home_page.php">
                <div class="price-range-filter">
                    <h2>Price filter</h2>
                    <div class="price-range-filter-inputs">
                        <input type="number" name="min_price" maxlength="13" id="min_price" placeholder="MIN">
                        <div class="filter-range-line"></div>
                        <input type="number" name="max_price" maxlength="13" id="max_price" placeholder="MAX">
                        <button  type="submit" name="act" value="Filter" class="apply-button">APPLY</button>
                    </div>
               </form>

                <div class="special-deals" id="here">
                    <h3 class="special-deals-header">All products</h1>
                
                <?php

                $file = fopen('../dbFiles/Product.csv', 'r');

                // Headers
                $headers = fgetcsv($file);

                // Rows
                // $_SESSION['data'] = $data;
                $data = [];
                while (($row = fgetcsv($file)) !== false)
                {
                    $item = [];
                    foreach ($row as $key => $value) 
                         $item[$headers[$key]] = $value ?: null;
                    
                    if (isset($_GET['min_price']) && is_numeric($_GET['min_price'])) {
                    if ($item['price'] < $_GET['min_price']) {
                        continue;
                    }
                    }
                    if (isset($_GET['max_price']) && is_numeric($_GET['max_price'])) {
                    if ($item['price'] > $_GET['max_price']) {
                        continue;
                    }
                    }
                    if (isset($_GET['name']) && !empty($_GET['name'])) {
                        if (strpos($item['name'], $_GET['name']) === false) {
                          continue;
                        }
                      }
                    
                    $data[] = $item;
                }
                $_SESSION['data'] = $data;
                $i = 1;
                echo '<div class="row-products">';
                foreach ($data as $item) {
                    $str = serialize($item);
                    $strenc = urlencode($str);

                    echo 
                        '
                        <div class="col-product">
                            <a href="./Product_details.php?data=' . $strenc .' ">
                                <img src="../img/'. $item['imagefileName'] .'" alt="">
                            <p class="product-des">'. $item['name'] .'</p>
                            <p class="price">'. $item['price'] .'</p>
                            </a>
                        </div>
                        ';
                        ++$i;
                }
                echo '</div>'; 
                // Close file
                fclose($file);
                ?>
            <script>
                console.log(<?= json_encode($_SESSION['data']); ?>);

            </script>
            <!-- </div> -->
                </div>

        </section>
            
        </section>
        <?php require '../php_scripts/general_footer.php'?>
    </body>
</html>