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
                    <?php echo "Hello Vendor: ".$_SESSION['current_user']['firstname']?>
                    <p>Add product details here</p>
                    <form method="post">
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

                            if($error == ''){

                                $form_data = array(
                                        'productID' => $productID,
                                        'name'  => $product_name,
                                        'type'  => $product_type,
                                        'description'  => $description,
                                        'imagefileName' => null,
                                        'price' => $price,
                                        'vendorUsername' => $username
                                        );
                                var_dump($form_data);
                                $data = 'productID'.$productID.','.'name'.$product_name.','.'type'.$product_type.','.'description'.$description.','
                                .'imagefileName'.null.','.'price'.$price.','.'vendorUsername'.$username;

                                $file_open = fopen('Product.csv', 'a+');
                                print_r(fgetcsv($file_open));
                                $filename = 'Product.csv';       
                                
                                fwrite($file_open, $data) or die('<script>console.log("Unsuccessful");</script>');

                                $error = '<label class="text-success">Thank you for contacting us</label>';
                                $productID = '';
                                $username = '';
                                $product_name = '';
                                $price = '';
                                $product_type = '';
                                $description = '';
                                
                            }
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
                            <p>No file chosen</p>
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
                <li><a href="/test/test.php">Copyright</a></li>
                <li><a href="#">Policy</a></li>
                <li><a href="#">Helps link</a></li>   
            </ul>
        </footer>
    </body>
</html>