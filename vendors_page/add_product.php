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
                        <p>Shoppepepepepepe</p>
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
            <?php 
                $error = '';
                $seller_email ='';
                $product_name = '';
                $product_tag = '';
                $product_type = '';
                $description = '';

                function clean_text($data){
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;
             
                 }

                if (isset($_POST['submit'])) {
                    if (empty($_POST['seller-email'])) {
                        $error .= '<p><label class="text-danger">Please enter your email</label></p>';
                    } else
                    {
                     $seller_email = clean_text($_POST["seller-email"]);
                     if(!filter_var($email, FILTER_VALIDATE_EMAIL))
                     {
                      $error .= '<p><label class="text-danger">Invalid email format</label></p>';
                     }
                    }
                    if (empty($_POST['product-name'])) {
                        $error .= '<p><label class="text-danger">Please enter product name</label></p>';
                    }else{
                        $product_name = clean_text($_POST["product-name"]);
                    }
                    if (empty($_POST['product-type'])) {
                        $error .= '<p><label class="text-danger">Please enter product type</label></p>';
                    }else{
                        $product_type = clean_text($_POST["product-type"]);
                    }
                    if (empty($_POST['description'])) {
                        $error .= '<p><label class="text-danger">Please enter product description</label></p>';
                    }else{
                        $description = clean_text($_POST["description"]);
                    }
                    if (empty($_POST['product-tag'])) {
                        $error .= '<p><label class="text-danger">Please enter product tag</label></p>';
                    }else{
                        $product_tag = clean_text($_POST["product-tag"]);
                    }

                    if ($error == '') {
                        $file_open = fopen("products.csv", "a");
                        $no_rows = count(file("products.csv"));
                        if($no_rows > 1){
                            $no_rows = ($no_rows -1) +1;
                        }
                        $form_data = array(
                            'seller-email' => $seller_email,
                            'product-name' => $product_name,
                            'product-type' => $product_type,
                            'description' => $description,
                            'product-tag' => $product_tag
                        );
                        fputcsv($file_open, $form_data);
                        $error = '<label class="text-success">Upload product successfully</label>';
                        $seller_email = '';
                        $product_name = '';
                        $product_type = '';
                        $description = '';
                        $product_tag = '';
                    }
                }
            ?>
            <div class="container">
                <form action="add_product.php" method="POST" enctype="multipart/form-data">
                    <div class="contain-input">
                        <label for="seller-email">SELLER EMAIL</label>
                        <input type="text" name="seller-email" id="seller-email" value="<?php echo $seller_email; ?>">
                    </div>
                    <div class="contain-input">
                        <label for="product-name">PRODUCT NAME</label>
                        <input type="text" name="product-name" id="product-name" value="<?php echo $product_name; ?>">
                    </div>
                    <div class="contain-input">
                        <label for="product-type">PRODUCT TYPE</label>
                        <input type="text" name="product-type" id="product-type" value="<?php echo $product_type; ?>"> 
                    </div>
                    <div class="contain-input">
                        <label for="description">DESCRIPTION</label>
                        <input type="text" name="description" id="description" value="<?php echo $description; ?>">
                    </div>
                    <div class="contain-input">
                        <label for="product-tag">PRODUCT TAG</label>
                        <input type="text" name="product-tag" id="product-tag" value="<?php echo $product_tag; ?>">
                    </div>
                    <div class="contain-input">
                    <label for="product-image">Product Image</label>
                            <input id="product-image" type="file" name="product-image">
                    </div>
                    <div class="submit-container">
                        <input type="submit" id="submit" name="submit" value="Submit">
                    </div>
                </form>
            </div>
            <div class="product-img-input">
            <div class="chosen-file">
                        <img src="#product-image" alt="chosen file">
                        <p>No file chosen</p>
                    </div>
                    <h4>Note:</h4>
                    <p>Image can be uploaded of any dimension but we reccomend you to 
                        upload image with dimension of 1024x1024 & its size must be less than 15MB.
                    </p>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" class="save-changes" value="Upload" />
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