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
        
        <section class="cart-detail-page">
        <div class="cart-container">
        <form id="cartform" action="Customer_cart.php" method="post" name="ShoppingList" class="cart-container">
            <div id="items_table">
                
                <?php 
                $orderID = rand(10, 100);
                $username = $_SESSION["current_user"]["username"];

                echo
                '
                <input type="hidden" value="'. $orderID .'" name="orderID">
                <input type="hidden" value="'. $username .'" name="username">
                '
                ?>
                <h2>Shopping List</h2>
                <br>
                <table name="list" id="list"></table>
                <?php 
                $rand = rand(0,2);
                $hubID = ["123A", "123B", "123C"];
                $randHub = $hubID[$rand];
                echo
                '
                <input type="hidden" value="active" name="status">
                <input type="hidden" value="'.$randHub.'" name="hubID">
                <input type="hidden" value="0" name="shippingCost">
                '
                ?>
                <input class="clear-button" type="button" value="Clear" onclick="ClearAll()">
            </div>
            <button onClick="Reset()" class="order-button" type="submit" >Order Now</button>            
            <button type="button" onclick="location.href='/Customer_pages/Customer_home_page.php'" class="home-button">Homepage</button>            

        </form>


        </section>

        <table>
        <?php 
    $file = fopen('../dbFiles/Order.db.csv', 'a');
    fputcsv($file, $_POST );
    fclose($file);

?>
</table>


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

    window.load=doShowAll();
    function CheckBrowser() {
    if ('localStorage' in window && window['localStorage'] !== null) {
        // We can use localStorage object to store data.
        return true;
    }
        else {
            return false;
    }
}
    function doShowAll() {
    if (CheckBrowser()) {
        var key = "";
        var list = "<tr><th>Item Name  &nbsp;&nbsp;</th><th>Price</th><th>Vendor</th></tr>\n";
        var i = 0;
        var totalPrice=0;
        var productlist=[];
        var value = "";
        for (i = 0; i <= localStorage.length-1; i++) {
            key = localStorage.key(i);
            // lay array ra
            value = JSON.parse(localStorage.getItem(key))
            console.log(value);    
            var name = value[0];      
            var price = value[1];
            var vendor = value[2]; 
            //show
            list += "<tr><td>" + name + "</td>\n<td>"
                    + price + "</td>\n<td><input type='hidden' value='"+ vendor+"' name='vendor'>"+ vendor + "</td></tr>\n";
            totalPrice += parseInt(price)
            productlist.push(name);
                }

        if (list == "<tr><th>Item</th><th>Value</th></tr>\n") {
            list += "<tr><td><i>No item in cart</i></td></tr>\n";
        }
        list += "<tr><td class='table_title'>Total</td><td><input type='hidden' value='"+ totalPrice +"' name='totalPrice'>" + totalPrice + "</td>\n";
        list += "<tr><td class='table_title'>Product Items</td><td><input type='hidden' value='"+ productlist+"' name='productlist'>" + productlist + "</td>\n";
        console.log(localStorage);
        
        document.getElementById('list').innerHTML = list;
    } else {
        alert('Cannot save shopping list as your browser does not support HTML 5');
    }
}

function RemoveItem()
{
var name=document.forms.ShoppingList.name.value;
document.forms.ShoppingList.data.value=localStorage.removeItem(name);
doShowAll();
}
function ClearAll() {
    localStorage.clear();
    doShowAll();
}
function Reset() {
    // document.getElementById('list').remove();
    localStorage.clear();
    // ClearAll();

}
</script>