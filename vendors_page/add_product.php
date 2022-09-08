<!DOCTYPE html>

<html>
    <head>
        <title>Shoppee web</title>
        <link rel="stylesheet" href="../resources/css/style.css">
        <script defer src="/resources/js/regis.js"></script>
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
        <section class="add-product-page">
            <div class="page-path">
                <p ><a href="view_my_products.html">PRODUCTS</a> / <a href="">ADD PRODUCT</a></p>
            </div>
            <div class="header-add-products">
                <h1>ADD PRODUCT</h1>
                <h2>Here you can add product to your store.</p>
            </div>
            <div class="product-form-img-container">
                <div class="product-form">
                    <h3>PRODUCT DETAILS</h3>
                    <p>Add product details here</p>
                    <form action="#" method="#">
                        <div class="contain-input">
                            <label for="username">VENDOR USERNAME <span>*</span></label> <br>
                            <input type="text" name="username" id="username" onkeyup="validateName()">
                            <span id="nameError"></span>
                        </div>
                            <div class="contain-input">
                            <label for="product-name">PRODUCT NAME <span>*</span></label> <br>
                            <input type="text" name="product-name" id="product-name" onkeyup="validateProductName()">
                        <span id="pNameError"></span> <br>
                        </div>
                        <div class="contain-input">
                            <label for="price">PRODUCT PRICE (VND) <span>*</span></label> <br>
                            <input type="text" name="price" id="price" onkeyup="validatePrice()">
                            <span id="priceError"></span> <br>
                        </div>
                        <div class="contain-input">
                            <label for="product-type">PRODUCT TYPE <span>*</span></label> <br>
                            <input type="text" name="product-type" id="product-type" onkeyup="validatepProductType()">
                            <span id="pTypeError"></span> <br>
                        </div>
                        <div class="contain-input">
                            <label for="description">DESCRIPTION <span>*</span></label> <br>
                            <textarea name="desciption" id="desciption" cols="60" rows="10" onkeyup="validatepDescription()"></textarea>
                            <span id="desciptionError"></span> <br>
                        </div>
                    </form>
                </div>
                <div class="product-img-input">
                    <div class="chosen-file" id="imgBox">
                        <p>No file chosen</p>
                    </div>
                    <h4>Note:</h4>
                    <p>Image can be uploaded of any dimension but we reccomend you to 
                        upload image with dimension of 1024x1024 & its size must be less than 15MB.
                    </p>
                </div>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" class="save-changes" value="Upload" />
             </div>
        </section>
        <footer>
            <ul>
                <li><a href="#">About</a></li>
                <li><a href="/test/test.php">Copyright</a></li>
                <li><a href="#">Policy</a></li>
                <li><a href="#">Helps link</a></li>   
            </ul>
        </footer>
    </body>
</html>