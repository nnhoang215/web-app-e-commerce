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
                echo '<h1>My Account ('.$_SESSION['current_user']['role'].')</h1>';
            ?>
                <div class="container">
                    <?php 
                        $_avatarLink = $_SESSION["current_user"]["imageURL"];
                        echo '<div><img width="300px" src="'.$_avatarLink.'" alt="profile-picture"></div>';
                    ?>
                    <div class="information">
                        <?php
                            switch ($_SESSION['current_user']['role']) {
                                case "customer":
                                    echo '
                                    <div class="row">
                                        <div class="username">
                                            Username: <span>'.$_SESSION['current_user']['username'].'</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="name">Name: <span> '.$_SESSION['current_user']['firstname'].' '.$_SESSION['current_user']['lastname'].'</span>
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class="DOB">
                                            Date Of Birth: <span>'.$_SESSION['current_user']['DOB'].'</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="Address">Email: <span>'.$_SESSION['current_user']['email'].'</span></div>
                                    </div>
                                    <div class="row">
                                        <div class="Address">Address: <span>'.$_SESSION['current_user']['address'].'</span></div>
                                    </div>
                                    <div class="row">
                                        <div class="gender">Gender: <span>'.$_SESSION['current_user']['gender'].'</span></div>
                                    </div>
                                    ';
                                    break;
                                case "vendor":
                                    echo '
                                    <div class="row">
                                        <div class="username">
                                            Username: <span>'.$_SESSION['current_user']['username'].'</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="name">Business Name: <span> '.$_SESSION['current_user']['business-name'].'</span>
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class="Business-address">Business Address: <span>'.$_SESSION['current_user']['business-address'].'</span></div>
                                    </div>                              
                                    ';
                                    break;
                                case "shipper":
                                    echo '
                                    <div class="row">
                                        <div class="username">
                                            Username: <span>'.$_SESSION['current_user']['username'].'</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="name">Name: <span> '.$_SESSION['current_user']['firstname'].' '.$_SESSION['current_user']['lastname'].'</span>
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class="age">
                                            Age: <span>'.$_SESSION['current_user']['age'].'</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="hub">Distribution Hub: <span>'.$_SESSION['current_user']['distributionHub'].'</span></div>
                                    </div>
                                    ';
                                    break;
                                default:
                                    echo 'Sorry, something wrong happened, please register again';
                                    break;
                            }
                        ?>
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