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
                    <div class="profile-img"><img src="https://scontent.fhan2-1.fna.fbcdn.net/v/t39.30808-6/272953150_4284994721600824_7339779710394681320_n.jpg?_nc_cat=101&ccb=1-7&_nc_sid=09cbfe&_nc_ohc=u6uSccsI91wAX_0X_HC&_nc_ht=scontent.fhan2-1.fna&oh=00_AT_FEji993tbcNnvFzmUPYVzW89kW8fi77uSWOTBRokYbg&oe=6309D0A6" alt="profile-picture"></div>
                    <div class="information">
                        <div class="row">
                            <div class="name">Name: <span>Gia Thanh Nguyen</span></div>    <!-- insert user information into span  -->
                        </div>
                        <div class="row">
                            <div class="DOB">Date Of Birth: <span>01/11/2002</span></div>
                        </div>
                        <div class="row">
                            <div class="Address">Address: <span>RMIT HANOI</span></div>
                        </div>
                        <div class="row">
                            <div class="gender">Gender: <span>Man</span></div>
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