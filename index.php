<?php
    session_start();
?>
<!DOCTYPE html>

<html>
    <head>
        <?php require './php_scripts/general_head.php'?>
    </head>
    <body>
        <header>
            <?php require './php_scripts/general_header.php' ?>
        </header>
        <section> 
            <div class="home-page">
                Welcome to Shopee E-commerce app!
            </div>
        </section>
        <footer>
            <ul>
                <li><a href="./sub-pages/About.html">About</a></li>
                <li><a href="./sub-pages/Copyright.html">Copyright</a></li>
                <li><a href="./sub-pages/Policy.html">Policy</a></li>
                <li><a href="./sub-pages/Helpslink.html">Helps link</a></li>
                <!-- <li><a href="./Customer_pages/Customer_home_page.php">Customer-homepage</a></li> 
                <li><a href="./Customer_pages/Product_details.html">Product details</a></li>  
                <li><a href="./Customer_pages/products_page.html">Product page</a></li>
                <li><a href="./Myaccount/Myaccount.html">My Account</a></li>
                <li><a href="./regis_pages/regis_cus.php">Customer regis</a></li>
                <li><a href="./regis_pages/regis_shipper.php">Shipper regis</a></li>
                <li><a href="./regis_pages/regis_vendors.php">Vendor regis</a></li>
                <li><a href="./Vendors_page/add_product.php">Add product</a></li>
                <li><a href="./Vendors_page/view_my_products.php">View product</a></li> -->
            </ul>
        </footer>
    </body>
</html>