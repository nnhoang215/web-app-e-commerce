<?php
  $_redirectLink = isset($_SESSION["current_user"]) ? "../Myaccount/Myaccount.php" : "../../index.php";
  $_homePageLink = "../../index.php";

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
  $_login = isset($_SESSION["current_user"]) ? "Welcome, ".$_SESSION['current_user']['username']."!" : "<li><a href=".$_redirectLink.">Log in</a></li>";

  echo 
  '<nav>
    <div class="nav-bar">
        <div class="logo-name">
            <a href="../../index.php"><img src="../img/shopee_logo.png" alt="logo"></a>
            <p><a href="../../index.php">The world\'s biggest E-commerce application</a></p>
        </div>
        <div class="nav">
            <ul>
                <li><a href="'.$_homePageLink.'">Home</a></li>
                <li><a href="'.$_redirectLink.'">My Account</a></li>
                '.$_login.'
            </ul>
        </div>
    </div>
  </nav>';
?>