<!DOCTYPE html>

<html>
    <head>
        <title>Shoppee web</title>
        <link rel="stylesheet" href="../resources/css/style.css">
        <link rel="stylesheet" href="../resources/css/queries.css">

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
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    $age = $_POST['age'];
                    $distributionHub = $_POST['distribution-hub'];
                    $file = " ";
                    $path_filename_ext = " ";
                    $temp_name = " ";
                    if (($_FILES['profile_image']['name']!="" && $_FILES['profile_image']['size'] < 15000
                    && ($_FILES['profile_image']['type'] == "image/jpg") || ($_FILES["profile_image"]["type"] == "image/jpeg") || ($_FILES["profile_image"]["type"] == "image/png"))){
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
                    .","."null".","."null".",".$age.","."shipper".",".$distributionHub.",".$path_filename_ext."\n";

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
                        for($i = 1; $i < count($records); $i++){    
                            array_push($userNameList, $records[$i][0]);   
                        }
                        if(isInArray($userNameList, validate($userName)) == true){
                            header("Location: regis_shipper.php");
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
                        ###################### Upload image #############################
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
                <form action="regis_customer.php" method="post" enctype="multipart/form-data">
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
                            <label for="age">Age</label>
                            <input type="text" name="age" id="age" >
                        </div>
                        <div class="col">
                            <label for="distribution-hub">Distribution Hub</label>
                            <select name="distribution-hub" id="distribution-hub">
                                <option value="RMIT SGS Hub">RMIT SGS Hub</option>
                                <option value="RMIT Hanoi Hub">RMIT Hanoi Hub</option>
                                <option value="RMIT Danang Hub">RMIT Danang Hub</option>
                            </select>
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
                <li><a href="../sub-pages/About.html">About</a></li>
                <li><a href="../sub-pages/Copyright.html">Copyright</a></li>
                <li><a href="../sub-pages/Policy.html">Policy</a></li>
                <li><a href="../sub-pages/Helpslink.html">Helps link</a></li>   
            </ul>
        </footer>
    </body>
</html>