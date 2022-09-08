<?php
    session_start();
?>
<!DOCTYPE html>

<html>
    <head>
        <title>Shoppee web</title>
        <link rel="stylesheet" href="/resources/css/style.css">
    </head>
    <body>
        <header>
            <?php require '../php_scripts/general_header.php'?>
        </header>
        <section class="my-account">
            <?php
                if (isset($_POST['log_out'])){
                    unset($_SESSION["current_user"]);
                    session_destroy();
                    header("Location: ../Login/login.php");
                }
            ?>
            <h1>My Account</h1>
                <div class="container">
                    <?php 
                        $_avatarLink = $_SESSION["current_user"]["imageURL"];
                        echo '<div><img width="300px" src="'.$_avatarLink.'" alt="profile-picture"></div>';
                    ?>
                    <div class="information">
                        <div class="row">
                            <div class="name">Name: <span><?php echo $_SESSION['current_user']['firstname'] ." ". $_SESSION['current_user']['lastname']; ?></span></div> 
                        </div>
                        <div class="row">
                            <div class="name">Business Name: <span><?php echo $_SESSION['current_user']['business-name'] ." ". $_SESSION['current_user']['lastname']; ?></span></div> 
                        </div>
                        <div class="row">
                            <div class="DOB">
                                Date Of Birth: <span><?php echo $_SESSION['current_user']['DOB']; ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="Address">Email: <span><?php echo $_SESSION['current_user']['email'];?></span></div>
                        </div>
                        <div class="row">
                            <div class="Address">Address: <span><?php echo $_SESSION['current_user']['address'];?></span></div>
                        </div>
                        <div class="row">
                            <div class="Address">Business Address: <span><?php echo $_SESSION['current_user']['business-address'];?></span></div>
                        </div>
                        <div class="row">
                            <div class="gender">Gender: <span><?php echo $_SESSION['current_user']['gender'];?></span></div>
                        </div>
                    </div>
                </div>
                <div class="btn">
                    <form action="Myaccount.php" method="post">
                        <button name="log_out" value="true">Log Out</button>
                    </form>
                </div>
        </section>
        <footer>
            <ul>
                <li><a href="#">About</a></li>
                <li><a href="#">Copyright</a></li>
                <li><a href="#">Policy</a></li>
                <li><a href="#">Helps link</a></li>   
            </ul>
        </footer>
    </body>
</html>