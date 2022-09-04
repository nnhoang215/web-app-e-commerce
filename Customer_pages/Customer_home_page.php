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
                    <div class="search-bar">
                        <input type="text" placeholder="  Search..." id="search-text">
                        <button type="submit" id="search"><i class="fa fa-search"></i></button>
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
        <section class="customer-home-pages">
                <div class="category-container">
                    <h2>Categories</h2>
                    <div class="categories">
                        <div class="category">
                            <a href="#">
                                <img src="#" alt="category">
                                <p>Category Name</p>
                            </a>
                        </div>
                        <div class="category">
                            <a href="#">
                                <img src="#" alt="category">
                                <p>Category Name</p>
                            </a>
                        </div>
                        <div class="category">
                            <a href="#">
                                <img src="#" alt="category">
                                <p>Category Name</p>
                            </a>
                        </div>
                        <div class="category">
                            <a href="#">
                                <img src="#" alt="category">
                                <p>Category Name</p>
                            </a>
                        </div>
                        <div class="category">
                            <a href="#">
                                <img src="#" alt="category">
                                <p>Category Name</p>
                            </a>
                        </div>
                        <div class="category">
                            <a href="#">
                                <img src="#" alt="category">
                                <p>Category Name</p>
                            </a>
                        </div>
                        <div class="category">
                            <a href="#">
                                <img src="#" alt="category">
                                <p>Category Name</p>
                            </a>
                        </div>
                    </div>
                    <div class="categories">
                        <div class="category">
                            <a href="#">
                                <img src="#" alt="category">
                                <p>Category Name</p>
                            </a>
                        </div>
                        <div class="category">
                            <a href="#">
                                <img src="#" alt="category">
                                <p>Category Name</p>
                            </a>
                        </div>
                        <div class="category">
                            <a href="#">
                                <img src="#" alt="category">
                                <p>Category Name</p>
                            </a>
                        </div>
                        <div class="category">
                            <a href="#">
                                <img src="#" alt="category">
                                <p>Category Name</p>
                            </a>
                        </div>
                        <div class="category">
                            <a href="#">
                                <img src="#" alt="category">
                                <p>Category Name</p>
                            </a>
                        </div>
                        <div class="category">
                            <a href="#">
                                <img src="#" alt="category">
                                <p>Category Name</p>
                            </a>
                        </div>
                        <div class="category">
                            <a href="#">
                                <img src="#" alt="category">
                                <p>Category Name</p>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="special-deals">
                    <h3 class="special-deals-header">Special Deals </h1>
                <div class="row-products">
                <div class="col-product">
                    <a href="#">
                        <img src="" alt="">
                    <p class="product-des">Product description</p>
                    <p class="price">Price</p>
                    </a>
                </div>
                <div class="col-product">
                    <a href="#">
                        <img src="" alt="">
                    <p class="product-des">Product description</p>
                    <p class="price">Price</p>
                    </a>
                </div>
                <div class="col-product">
                    <a href="#">
                        <img src="" alt="">
                    <p class="product-des">Product description</p>
                    <p class="price">Price</p>
                    </a>
                </div>
                <div class="col-product">
                    <a href="#">
                        <img src="" alt="">
                    <p class="product-des">Product description</p>
                    <p class="price">Price</p>
                    </a>
                </div>
                <div class="col-product">
                    <a href="#">
                        <img src="" alt="">
                    <p class="product-des">Product description</p>
                    <p class="price">Price</p>
                    </a>
                </div>
                <div class="col-product">
                    <a href="#">
                        <img src="" alt="">
                    <p class="product-des">Product description</p>
                    <p class="price">Price</p>
                    </a>
                </div>
            </div>
                </div>


                <div class="special-deals">
                    <h3 class="special-deals-header">All products</h1>
                <div class="row-products">
                
                <?php
                $file = fopen('../dbFiles/Product.db.csv', 'r');

                // Headers
                $headers = fgetcsv($file);

                // Rows
                $data = [];
                while (($row = fgetcsv($file)) !== false)
                {
                    $item = [];
                    foreach ($row as $key => $value)
                        $item[$headers[$key]] = $value ?: null;
                        echo 
                        '
                        <div class="col-product">
                            <a href="#">
                                <img src="/img/'. $item['imagefileName'] .'" alt="">
                            <p class="product-des">'. $item['name'] .'</p>
                            <p class="price">'. $item['price'] .'</p>
                            </a>
                        </div>
                        ';
                    $data[] = $item;
                }
                // Close file
                fclose($file);
                ?>
                
            </div>
                </div>
        </section>
            
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