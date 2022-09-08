<?php
    session_start();
?>
<!DOCTYPE html>

<html>
    <head>
        <title>Shopee web</title>
        <link rel="stylesheet" href="/resources/css/style.css">
    </head>
    <body>
        <header>
            <?php require '../php_scripts/general_header.php' ?>
        </header>
        <!-- <section class = "order_detail">
        <form action="order_detail.php" method="post">
            <div class="container">
                <div class="row">
                    <div class="col">Order ID: </div>
                    <div class="col">Buyer ID: </div>
                </div>
                <div class="row">
                    <div class="col">Vendor ID: </div>
                    <div class="col">Distrionbution Hub ID: </div>
                </div>
                <div class="row">
                    <div class="col">Products: </div>
                    <div class="col">Shipping Cost: </div>
                </div>
                <div class="row">
                    <div class="col">Total Amount: </div>
                    <div class="col"> 
                        <label for="order-status">Status</label>
                        <select name="order-status" id="order-status">
                            <option value="RMIT SGS Hub">RMIT SGS Hub</option>
                            <option value="RMIT Hanoi Hub">RMIT Hanoi Hub</option>
                            <option value="RMIT Danang Hub">RMIT Danang Hub</option>
                        </select>
                    </div>
                </div>
                <input type="submit" name="submit" id="submit" value="submit">
            </div>
        </form>
        </section> -->
        <?php
            $strenc2 = $_GET['data'];
            $arr = unserialize(urldecode($strenc2));

            echo 
                '
                <section class = "order_detail">
                <h1>Order Detail</h1>
                <form action="order_detail.php" method="post">
            <div class="container">
                <div class="row">
                    <div class="col">Order ID: '.$arr[0].'</div>
                    <div class="col">Buyer ID: '.$arr[1].'</div>
                </div>
                <div class="row">
                    <div class="col">Vendor ID: '.$arr[2].' </div>
                    <div class="col">Distrionbution Hub ID: '.$arr[5].' </div>
                </div>
                <div class="row">
                    <div class="col">Products: '.$arr[3].' </div>
                    <div class="col">Shipping Cost: '.$arr[6].' </div>
                </div>
                <div class="row">
                    <div class="col">Total Amount: '.$arr[7].' </div>
                    <div class="col"> 
                    <form action="order_detail.php" method="post">
                        <label for="order-status">Status</label>
                        <select name="order-status" id="order-status">
                            <option value="active">'.$arr[4].'</option>
                            <option value="canceled">canceled</option>
                            <option value="delivered">delivered</option>
                        </select>
                    </div>
                </div>
                <input type="submit" name="submit" id="submit" value="submit">
            </div>
            </form>
        </section>
          ';
        ?>
        <footer>
            <ul>
                <li><a href="./sub-pages/About.html">About</a></li>
                <li><a href="./sub-pages/Copyright.html">Copyright</a></li>
                <li><a href="./sub-pages/Policy.html">Policy</a></li>
                <li><a href="./sub-pages/Helpslink.html">Helps link</a></li>
            </ul>
        </footer>
    </body>
</html>