<!DOCTYPE html>

<html>
    <head>
        <title>Shoppee web</title>
        <link rel="stylesheet" href="../resources/css/style.css">
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
        
        <section class="product-details-page">
        <div class="cart-container">
        <form action="Customer_cart.php" method="post" name="ShoppingList" class="cart-container">
            <div id="items_table">
                <h2>Shopping List</h2>
                <br>
                <table name="list" id="list"></table>
                <input class="clear-button" type="button" value="Clear" onclick="ClearAll()">
            </div>
            <button  type="submit" class="apply-button">APPLY</button>


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
    } else {
            return false;
    }
}
    function doShowAll() {
    if (CheckBrowser()) {
        var key = "";
        var list = "<tr><th>Item Name  &nbsp;&nbsp;</th><th>Price</th></tr>\n";
        var i = 0;
        var totalPrice=0;
        var productlist=[];

        for (i = 0; i <= localStorage.length-1; i++) {
            key = localStorage.key(i);
            list += "<tr><td>" + key + "</td>\n<td>"
                    + localStorage.getItem(key) + "</td></tr>\n";
            totalPrice += parseInt(localStorage.getItem(key))
            productlist.push(key);
                }

        if (list == "<tr><th>Item</th><th>Value</th></tr>\n") {
            list += "<tr><td><i>No item in cart</i></td></tr>\n";
        }
        list += "<tr><td class='table_title'>Total</td><td><input type='hidden' value='"+ totalPrice +"' name='totalPrice'>" + totalPrice + "</td>\n";
        list += "<tr><td class='table_title'>Product Items</td><td><input type='hidden' value='"+ productlist+"' name='productlist'>" + productlist + "</td>\n";
        // console.log(localStorage);
        
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
</script>