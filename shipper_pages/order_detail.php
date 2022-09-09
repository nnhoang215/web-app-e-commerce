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
        <?php
            error_reporting(0);
            if($_GET['data'] != null){
                $strenc2 = " ";
                $arr = [];
                $currentBuyer = [];
                $strenc2 = $_GET['data'];
                $arr = unserialize(urldecode($strenc2));
                $_SESSION['current_order'] = $arr;

                ### Read file Customer.csv ######
                $file = "../regis_pages/Customer.csv";
                $fileHandle = fopen($file, 'r');
                flock($fileHandle, LOCK_SH);
                while($line = fgets($fileHandle)){
                    $records[] = explode(",", $line);
                }
                if($fileHandle == false){
                    die("Error opening file: ". $file);
                }
                flock($fileHandle, LOCK_UN);
                fclose($fileHandle);

                for($i = 0; $i < count($records); $i++){
                    if($records[$i][0] == $arr[1]){
                        $currentBuyer = $records[$i];
                    }
                }
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
                    <div class="row>
                        <div class="col">Receiver\'s address: '.$currentBuyer[7].'</div>     
                    
                    <input type="submit" name="submit" id="submit" value="submit">
                        </div>
                    </form>
                </section>';
            } 
            
            if(isset($_POST['submit'])){
                $newArr = $_SESSION['current_order'];
                $newStatus = $_POST['order-status'];
                $orderList = [];
                $fileOrder = "../dbFiles/Order.db.csv";
                $fileOrderHandle = fopen($fileOrder, "r");
                flock($fileOrderHandle, LOCK_SH);
                while($line = fgets($fileOrderHandle)){
                    $orderList[] = explode(",", $line);   
                }
                flock($fileOrderHandle, LOCK_UN);
                fclose($fileOrderHandle);
                for($i = 0; $i < count($orderList); $i++){
                    if($orderList[$i][0] == $newArr[0]){
                        $orderList[$i][4] = $newStatus;
                    }
                }
                $orderWrite = fopen($fileOrder, 'w');
                flock($orderWrite, LOCK_SH);
                foreach($orderList as $order){
                    $orderStr = implode(",", $order);
                    fwrite($orderWrite, $orderStr);
                }
                flock($orderWrite, LOCK_UN);
                fclose($orderWrite);
                header("Location: ./shipper_main_page.php");
            }
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