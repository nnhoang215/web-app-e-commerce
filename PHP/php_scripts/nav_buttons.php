<?php
    $_redirectLink = isset($_SESSION["current_user"]) ? "../Myaccount/Myaccount.php" : "../index.php";
    $_homePageLink = "../index.php";

    if (isset($_SESSION["current_user"])) {
    switch ($_SESSION["current_user"]["role"]) {
        case "customer":
        $_homePageLink = "../Customer_pages/Customer_home_page.php";
        break;
        case "vendor":
        $_homePageLink = "../vendors_page/view_my_products.php";
        break;
        case "shipper":
        $_homePageLink = "../shipper_pages/shipper_main_page.php";
        break;
    }
    }
    echo '<li><a href="'.$_homePageLink.'">Home</a></li>';
    echo '<li><a href="'.$_redirectLink.'">My Account</a></li>';
    $_login = isset($_SESSION["current_user"])
        ? "Welcome, ".$_SESSION['current_user']['firstname'] 
        : "<li><a href=".$_redirectLink.">Log in</a></li>";
    echo ''.$_login.'';
?>