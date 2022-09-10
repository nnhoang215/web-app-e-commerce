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
                <li><a href="./sub-pages/About.php">About</a></li>
                <li><a href="./sub-pages/Copyright.php">Copyright</a></li>
                <li><a href="./sub-pages/Policy.php">Policy</a></li>
                <li><a href="./sub-pages/Helpslink.php">Helps link</a></li>
            </ul>
        </footer>
    </body>
</html>