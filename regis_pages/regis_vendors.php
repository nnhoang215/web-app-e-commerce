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
                        <a href="#"><img src="" alt="logo"></a>
                        <p>Name</p>
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
        <section class="regis-form">
            <?php
                if(isset($_POST['submit'])){
                    error_reporting(0);
                    $records = array();
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $hased_password = password_hash($password, PASSWORD_DEFAULT);
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
                    }

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
                            array_push($businessAddressList, $records[$i][8]);   
                        }
                        if(isInArray($userNameList, validate($userName)) == true || isInArray($businessAddressList, validate($businessAddress)) == true){
                            header("Location: regis_vendors.php");
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
                        
                        // $target_dir = "/Users/nguyenhuugiathanh/Desktop/Web/img";
                        // $target_file = $target_dir . basename($_FILES["profile-image"]["name"]);
                        // $uploadOk = 1;
                        // $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                        // $check = getimagesize($_FILES["profile-image"]["tmp_name"]);
                        // if($check !== false) {
                        //     echo "File is an image - " . $check["mime"] . ".";
                        //     $uploadOk = 1;
                        // } else {
                        //     echo "File is not an image.";
                        //     $uploadOk = 0;
                        // }

                        // echo "true";
                        // var_dump($link);
                    }
                }
            ?>
            <div class="container">
                <form action="regis_vendor.php" method="post" enctype="multipart/form-data">
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
                            <input id="profile_image" type="file" name="profile_image">
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
                        <p>No file chosen</p>
                    </div>
                    <h4>Note:</h4>
                    <p>Image can be uploaded of any dimension but we reccomend you to 
                        upload image with dimension of 1024x1024 & its size must be less than 15MB.
                    </p>
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