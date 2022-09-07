<!DOCTYPE html>

<html>
    <head>
        <title>shopee web</title>
        <link rel="stylesheet" href="/resources/css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <header>
            <nav>
                <div class="nav-bar">
                    <div class="logo-name">
                        <a href="../index.html"><img src="/img/shopee_logo.png" alt="logo"></a>
                        <p>Shoppepepepepepe</p>
                    </div>
                    <form method="get" action="Customer_home_page.php">
                    <div class="search-bar">
                        <input type="text" name="name" placeholder="  Search..." id="search-text">
                        <button type="submit" name="act" id="search"><i class="fa fa-search"></i></button>
                    </div>
                    </form>
                    <div class="nav">
                        <ul>
                            <li><a href="#">My Account</a></li>
                            <li><a href="#">Log in</a></li>
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
                    <p class="product-details-name">'. $arr['name'] .'</p>
                    <p class="product-details-price">'. $arr['price'] .'</p>
                    <p class="product-details-des">'. $arr['description'] .'</p>
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

var name =  "<?php Print($arr['name']); ?>";
var price =  "<?php Print($arr['price']); ?>";
localStorage.setItem(name, price);
doShowAll();

}
</script>