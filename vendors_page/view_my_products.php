<?php
    session_start();
?>
<!DOCTYPE html>

<html>
    <head>
        <title>Shoppee web</title>
        <link rel="stylesheet" href="../resources/css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <header>
            <?php require '../php_scripts/general_header.php'?>
        </header>
        <section class="view-my-products">
            <div class="header-addmore">
                <div class="header-my-products">
                    <h1>My Products</h1>
                    <p>Here are the Current Products on your Store.</p>
                </div>
                <div class="btn">
                    <a href="add_product.html">+ ADD MORE</a>
                </div>
            </div>
            <div class="container-products">
            <?php 
                $file = fopen('../dbFiles/Product.csv', 'r');
                $headers = fgetcsv($file, 1000, ',');
                
                
                while(( $row = fgetcsv($file))!== false){
                    $item = [];
                    foreach ($row as $key => $value) 
                         $item[$headers[$key]] = $value ?: null;
            
                    $data[] = $item;
                    
                }
                $_SESSION['data'] = $data;
                $i = 1;
                foreach ($data as $item) {
                    if($i % 3 == 1) {echo '<div class="row-products">';}
                    $str = serialize($item);
                    $strenc = urlencode($str);
                    
                    if(isset($_SESSION['current_user'])){
                    
                        if($item["vendorUsername"]==$_SESSION['current_user']['username']){
                            echo 
                                '
                                <div class="col-product">
                                    <a href="./Product_details.php?data=' . $strenc .' ">
                                        <img src="/img/'. $item['imagefileName'] .'" alt="">
                                    <p class="product-des">'. $item['name'] .'</p>
                                    <p class="price">'. $item['price'] .'</p>
                                    <p class="vendorUsername">'.$item['vendorUsername'].'</p>
                                    </a>
                                </div>
                                ';
                                if($i % 3 == 0) {echo '</div>'; } 
                                ++$i;
                            }
                    }
                    
                }
                // Close file
                fclose($file);

            ?>
            <script>
            console.log(<?= json_encode($_SESSION['data']); ?>);

            </script>
                <!-- <div class="row-product">
                    <div class="col-product">
                        <a href="#">
                            <img src="" alt="product1">
                            <p>product name</p>
                        </a>
                </div> -->

                <div class="btn" id="view-more">
                    <a href="">View more</a>
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