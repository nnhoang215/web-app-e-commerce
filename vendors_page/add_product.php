<?php
    session_start();
?>
<!DOCTYPE html>

<html>
    <head>
        <title>Shoppee web</title>
        <script defer src="/resources/js/regis.js"></script>
        <link rel="stylesheet" href="../resources/css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <header>
            <?php require '../php_scripts/general_header.php'?>
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
                    <?php echo "Hello Vendor: ".$_SESSION['current_user']['username']?>
                    <p>Add product details here</p>
                    <form action="add_product.php" method="post" enctype="multipart/form-data">
                        <?php 
                        
                        function clean_text($string)
                        {
                         $string = trim($string);
                         $string = stripslashes($string);
                         $string = htmlspecialchars($string);
                         return $string;

                        }
                        $productID = '';
                        $username = '';
                        $product_name = '';
                        $price = '';
                        $product_type = '';
                        $description = '';
                        $error = '';
                        $file = " ";
                        $path_filename_ext = " ";
                        $tempName = " ";
                        
                        if(isset($_POST['submit']) && isset($_SESSION['current_user'])){
                            if(empty($_POST['productID'])){
                                $error .= '<p><label class="text-danger">Please Enter your Product ID</label></p>';
                            }else{
                                $productID = $_POST['productID'];
                            }
                            if(!preg_match("/P[0-9]/",$productID)){
                                $error .= '<p><label class="text-danger">ID can only have number</label></p>';
                            }

                            $username = $_SESSION['current_user']['username'];

                            if(empty($_POST["product-name"])){
                                $error .= '<p><label class="text-danger">Please Enter your Product name</label></p>';
                            }else{
                                $product_name = clean_text($_POST["product-name"]);
                            }

                            if(empty($_POST["price"])){
                                $error .= '<p><label class="text-danger">Price is required</label></p>';
                            }else{
                                $price = clean_text($_POST["price"]);}

                            if(!preg_match("/[0-9]/",$price)){
                                $error .= '<p><label class="text-danger">Only number is allowed</label></p>';          
                            }
                            if($price < 0){
                                $error .= '<p><label class="text-danger">Price cannot be negative value</label></p>';  
                            }
                            
                            if(empty($_POST["product-type"])){
                                $error .= '<p><label class="text-danger">Product type is required</label></p>';
                            }else{
                                $product_type = clean_text($_POST["product-type"]);
                            }

                            if(empty($_POST["description"])){
                                $error .= '<p><label class="text-danger">Description is required</label></p>';
                            }else{
                                $description = clean_text($_POST["description"]);
                            }

                                if (($_FILES['profile_image']['name']!="" && $_FILES['profile_image']['size'] < 15000
                                    && ($_FILES['profile_image']['type'] == "image/jpg") || ($_FILES["profile_image"]["type"] == "image/jpeg") || ($_FILES["profile_image"]["type"] == "image/png"))){
                                    $target_dir = "../img/";
                                    $file = $_FILES['profile_image']['name'];
                                    $path = pathinfo($file);
                                    $filename = $path['filename'];
                                    $ext = $path['extension'];
                                    $tempName = $_FILES['profile_image']['tmp_name'];
                                    $path_filename_ext = $target_dir.$filename.".".$ext;

                                    $data = $productID.','.$product_name.','.$product_type.','.$description.','.$price.','.$path_filename_ext.','.$username."\n";
                                
                                    $file_name = '../dbFiles/Product.csv';
                                    $file_open = fopen($file_name, 'a+');

                                    if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $path_filename_ext)) {
                                        echo "The file ". htmlspecialchars( basename( $_FILES["profile_image"]["name"])). " has been uploaded.";
                                    } else {
                                        echo "Sorry, there was an error uploading your file.";
                                    }
                                    
                                    flock($file_open,LOCK_SH);      
                                    
                                    fwrite($file_open, $data);

                                    flock($file_open, LOCK_UN);

                                    fclose($file_open);
                                } else {
                                    echo '<script>alert("File size is too big or the image type is not jpeg/jpg/png");</script>';
                                }

                                $error = '<label class="text-success">Adding product successfully</label>';
                                $productID = '';
                                $username = '';
                                $product_name = '';
                                $price = '';
                                $product_type = '';
                                $description = '';
                           }
                        ?>
                        
                        <?php echo $error;?>
                        <div class="contain-input">
                            <label for="productID">PRODUCT ID <span>*</span></label> <br>
                            <input type="text" name="productID" id="productID" onkeyup="validateProductID()" value="<?php echo $productID;?>">
                        <span id="pIDError"></span> <br>
                        </div>
                        <div class="contain-input">
                            <label for="product-name">PRODUCT NAME <span>*</span></label> <br>
                            <input type="text" name="product-name" id="product-name" onkeyup="validateProductName()" value="<?php echo $product_name;?>">
                        <span id="pNameError"></span> <br>
                        </div>
                        <div class="contain-input">
                        <label for="price">PRODUCT PRICE (VND) <span>*</span></label> <br>
                            <input type="text" name="price" id="price" onkeyup="validatePrice()" value="<?php echo $price;?>">
                            <span id="priceError"></span> <br>
                        </div>
                        <div class="contain-input">
                            <label for="product-type">PRODUCT TYPE <span>*</span></label> <br>
                            <input type="text" name="product-type" id="product-type" onkeyup="validatepProductType()" value="<?php echo $product_type;?>">
                            <span id="pTypeError"></span> <br>
                        </div>
                        <div class="contain-input">
                            <label for="description">DESCRIPTION <span>*</span></label> <br>
                            <textarea name="description" id="description" cols="60" rows="10" onkeyup="validatepDescription()"><?php echo $description;?></textarea>
                            <span id="descriptionError"></span> <br>
                        </div>

                    <div class="product-img-input">
                        <div class="chosen-file" id="imgBox">
                            <img  src="../img/no_image.jpeg" alt="chosen file">
                        </div>
                        <div class="product_image">
                            <input type="file" name="profile_image" id="profile_image" accept="image/*" required>
                            
                        </div>
                        <h4>Note:</h4>
                        <p>Image can be uploaded of any dimension but we reccomend you to 
                            upload image with dimension of 1024x1024 & its size must be less than 15MB.
                        </p>
                    </div>

                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-info" value="Submit" />
                    </div>
                </form>
                </div>
                
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
    <script src="../resources/js/preview_img.js"></script>
</html>