<!DOCTYPE html>

<html>
    <head>
        <?php require '../php_scripts/general_head.php'?>
    </head>
    <body>
        <header>
            <?php require '../php_scripts/general_header.php'?>
        </header>
        <section class="regis-form">
            <?php
                if(isset($_POST['submit'])){
                    // error_reporting(0);
                    $records = array();
                    $userName = $_POST['username'];
                    $password = $_POST['password'];
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    $businessName = $_POST['business-name'];
                    $businessAddress = $_POST['business-address'];
                    $file = " ";
                    $path_filename_ext = " ";
                    $temp_name = " ";
                    if ($_FILES['profile_image']['name']!="" && $_FILES['profile_image']['size'] < 15000
                        && ($_FILES['profile_image']['type'] == "image/jpg") || ($_FILES["profile_image"]["type"] == "image/jpeg") || ($_FILES["profile_image"]["type"] == "image/png")){
                        // Where the file is going to be stored
                        $target_dir = "../img/";
                        $file = $_FILES['profile_image']['name'];
                        $path = pathinfo($file);
                        $filename = $path['filename'];
                        $ext = $path['extension'];
                        $temp_name = $_FILES['profile_image']['tmp_name'];
                        $path_filename_ext = $target_dir.$filename.".".$ext;
                        $information = $userName.",".$hashed_password.","."null".","."null".","."null".","."null".","."null".","."null"
                        .",".$businessName.",".$businessAddress.","."null".","."vendor".","."null".",".$path_filename_ext."\n";

                        if(usernameValidate($userName)){
                            $csvFile = 'Customer.csv';
                            $file_handle = fopen($csvFile, 'a+');
                            flock($file_handle, LOCK_SH);
                            
                            $file = "Customer.csv";
                            $_file_handle = fopen($file, 'r');
                            flock($_file_handle, LOCK_SH);
                            while ($line = fgets($_file_handle)){
                                $records[] = explode(",", $line);
                            }
                            if($_file_handle == false){
                                die("Error opening file: ". $file);
                            }
                            flock($_file_handle, LOCK_UN);
                            fclose($_file_handle);
                            $userNameList = array();
                            $businessAddressList = array();
                            for($i = 1; $i < count($records); $i++){    
                                array_push($userNameList, $records[$i][0]);
                                array_push($businessAddressList, $records[$i][9]);   
                            }
                            
                            if(isInArray($userNameList, validate($userName)) == true || isInArray($businessAddressList, validate($businessAddress)) == true){
                                // header("Location: regis_vendors.php");
                                echo '<script>alert("Username or business address is already registered");</script>';
                            } else {
                                fwrite($file_handle, $information);
                                move_uploaded_file($temp_name,$path_filename_ext);
                                header("Location: ../Login/login.php");
                            }

                            if($file_handle == false){
                                die("Error opening file: ". $csvFile);
                            }

                            flock($file_handle, LOCK_UN);
                            fclose($file_handle);
                        }
                    } else {
                        echo '<script>alert("File size is too big or the image type is not jpeg/jpg/png");</script>';
                    }
                }
                function validate($data){

                    $data = trim($data);
             
                    $data = stripslashes($data);
             
                    $data = htmlspecialchars($data);
             
                    return $data;
             
                 }
                function isInArray($array, $item){
                    for($i = 0 ; $i < count($array); $i++){
                        if($item === $array[$i]){
                            return true;
                        }
                    }
                    return false;
                }

                function usernameValidate($userName){
                    $pattern = '/^[A-Za-z0-9]{5,31}$/';

                    if(preg_match($pattern,$userName)){
                        return true;
                    }
                    return false;
                }
            ?>
            <div class="container">
                <form action="regis_vendors.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col">
                            <label for="username">User name</label>
                            <input type="text" name="username" id="username">
                        </div>
                        <div class="col">
                            <label for="password">New Password</label>
                            <input type="text" name="password" id="password">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="business-name">Business Name</label>
                            <input type="text" name="business-name" id="business-name" >
                        </div>
                        <div class="col">
                            <label for="business-address">Business Address</label>
                            <input type="text" name="business-address" id="business-address">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="profile_image">Profile Image</label>
                            <input id="profile_image" type="file" accept="image/*" name="profile_image">
                        </div>
                    </div>
                    <div class="submit-container">
                        <input type="submit" id="submit" name="submit">
                    </div>
                </form>
            </div>
            <div class="product-img-input">
                    <div class="chosen-file">
                        <img src="#profile-image" alt="chosen file">
                    </div>
                    <h4>Note:</h4>
                    <p>Image can be uploaded of any dimension but we reccomend you to 
                        upload image with dimension of 1024x1024 & its size must be less than 15MB.
                    </p>
                </div>
        </section>
        <footer>
            <ul>
                <li><a href="../sub-pages/About.html">About</a></li>
                <li><a href="../sub-pages/Copyright.html">Copyright</a></li>
                <li><a href="../sub-pages/Policy.html">Policy</a></li>
                <li><a href="../sub-pages/Helpslink.html">Helps link</a></li>   
            </ul>
        </footer>
        <script src="../resources/js/preview_img.js"></script>
    </body>
</html>