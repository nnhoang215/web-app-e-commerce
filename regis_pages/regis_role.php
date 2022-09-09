<!DOCTYPE html>

<html>
    <head>
        <title>Shoppee web</title>
        <link rel="stylesheet" href="../resources/css/style.css">
        <link rel="stylesheet" href="../resources/css/queries.css">
    </head>
    <body>
        <header>
            <?php require '../php_scripts/general_header.php'?>
        </header>
        <section class = "roles">
            <h1>Who are you?</h1>
            <div class="role-box">
                <a href="regis_cus.php">Customer</a>
            </div>
            <div class="role-box">
                <a href="regis_vendors.php">Vendor</a>
            </div>
            <div class="role-box">
                <a href="regis_shipper.php">Shipper</a>
            </div>
        </section>
        <footer>
            <ul>
                <li><a href="../sub-pages/About.html">About</a></li>
                <li><a href="../sub-pages/Copyright.html">Copyright</a></li>
                <li><a href="../sub-pages/Policy.html">Policy</a></li>
                <li><a href="../sub-pages/Helpslink.html">Helps link</a></li>   
            </ul>
        </footer>
    </body>
</html>