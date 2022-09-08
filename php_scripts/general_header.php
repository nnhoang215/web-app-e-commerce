<?php
  $_redirectLink = isset($_SESSION["current_user"]) ? "../Myaccount/Myaccount.php" : "../Login/login.php";

  $_login = isset($_SESSION["current_user"]) ? "Welcome, ".$_SESSION['current_user']['firstname'] : "<li><a href=".$_redirectLink.">Log in</a></li>";

  echo 
  '<nav>
    <div class="nav-bar">
        <div class="logo-name">
            <a href="../index.php"><img src="/img/shopee_logo.png" alt="logo"></a>
            <p><a href="../index.php">The world\'s biggest E-commerce application</a></p>
        </div>
        <div class="nav">
            <ul>
                <li><a href="'.$_redirectLink.'">My Account</a></li>
                '.$_login.'
            </ul>
        </div>
    </div>
  </nav>';
?>