<!DOCTYPE html>

<html>
    <head>
        <title>Shoppee web</title>
        <link rel="stylesheet" href="../resources/css/style.css">
    </head>
    <body>
        <header>
            <nav>
                <div class="nav-bar">
                    <div class="logo-name">
                        <a href="../index.html"><img src="/img/shopee_logo.png" alt="logo"></a>
                        <p>Shoppee</p>
                    </div>
                    <div class="nav">
                        <ul>
                            <li><a href="#">My Account</a></li>
                            <li><a href="#">Log in</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
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
                $data = fgetcsv($file, 1000, ',');
                $all_record_arr = [];

                while(( $data = fgetcsv($file, 1000, ','))!== false){
                    echo "<pre>";
                    $all_record_arr = $data;
                    print_r($all_record_arr);
                }
                fclose($file);

            ?>
                <!-- <div class="row-product">
                    <div class="col-product">
                        <a href="#">
                            <img src="" alt="product1">
                            <p>product name</p>
                        </a>
                </div> -->
                <table border="1">
                    <thead>
                        <th>productID</th><th>name</th><th>type</th><th>description</th><th>price</th><th>sellerUsername</th>
                    </thead>
                    <tbody>
                        <?php foreach($all_record_arr as $rec) {?>
                            <tr>
                                <td><?=$rec[0]?></td>
                                <td><?=$rec[1]?></td>
                                <!-- <td><?=$rec[2]?></td>
                                <td><?=$rec[3]?></td>
                                <td><?=$rec[4]?></td>
                                <td><?=$rec[6]?></td> -->
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

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