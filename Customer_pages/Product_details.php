<?php
    session_start();
?>
<!DOCTYPE html>

<html>
    <head>
        <?php require '../php_scripts/general_head.php'?>
    </head>
    <body>
        <header>
            <nav>
                <div class="nav-bar">
                    <div class="logo-name">
                        <a href="../index.php"><img src="/img/shopee_logo.png" alt="logo"></a>
                        <p><a href="../index.php">The world's biggest E-commerce application</a></p>
                    </div>
                    <form method="get" action="Customer_home_page.php">
                    <div class="search-bar">
                        <input type="text" name="name" placeholder="  Search..." id="search-text">
                        <button type="submit" name="act" id="search"><i class="fa fa-search"></i></button>
                    </div>
                    </form>
                    <div class="nav">
                        <ul>
                            <?php require '../php_scripts/nav_buttons.php'?>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <?php
        
        // $productID = $_GET['productID'];
        $strenc2= $_GET['data'];
        $arr = unserialize(urldecode($strenc2));

        echo '
        <section class="product-details-page">
               <div class="page-path">
                <p>
                    <a href="./Customer_home_page.php">Home page</a>
                    <span> > </span>
                    <a href="#">'. $arr['name'] .'</a>
                </p>
               </div>
               <div class="product-details-container">
                    <div class="col-product">
                    <img src="/img/'. $arr['imagefileName'] .'" alt="">
                    <p class="product-details-name">Product Name: '. $arr['name'] .'</p>
                    <p class="product-details-des">ProductID: '. $arr['productID'] .'</p>
                    <p class="product-details-price">Price(VND): '. $arr['price'] .'</p>
                    <p class="product-details-des">Description: '. $arr['description'] .'</p>
                    <p class="product-details-des">Vendor: '. $arr['vendorUsername'] .'</p>
                    <form method="get" action="Customer_cart.php">
                        <button onclick="SaveItem()" type="submit" name="act" > Add to cart </button>
                    </form>
                </div>
               </div>
        </section>
        '
        ?>
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

<script>
function SaveItem() {
    var productID = "<?php Print($arr['productID']); ?>";
    var name =  "<?php Print($arr['name']); ?>";
    var price =  "<?php Print($arr['price']); ?>";
    var vendor =  "<?php Print($arr['vendorUsername']); ?>";
    var productValue = []

    productValue.push(name,price,vendor);
    localStorage.setItem(productID, JSON.stringify(productValue));

}
</script>