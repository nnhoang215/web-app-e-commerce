<!DOCTYPE html>

<html>
    <head>
        <title>Shoppee web</title>
        <link rel="stylesheet" href="../resources/css/style.css">
        <link rel="stylesheet" href="../resources/css/queries.css">
    </head>
    <body>
        <header>
            <?php require '../php_scripts/general_header.php'?>
        </header>
        <section class="regis-form">
            <?php
                if(isset($_POST['submit'])){
                    $records = array();
                    $userName = $_POST['username'];
                    $password = $_POST['password'];
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    $firstName = $_POST['firstname'];
                    $lastName = $_POST['lastname'];
                    $email = $_POST['email'];
                    $gender = $_POST['gender'];
                    $DOB = $_POST['DOB'];
                    $address = $_POST['address'];
                    $file = " ";
                    $path_filename_ext = " ";
                    $tempName = " ";
                    if (($_FILES['profile_image']['name']!="" && $_FILES['profile_image']['size'] < 15000
                        && ($_FILES['profile_image']['type'] == "image/jpg") || ($_FILES["profile_image"]["type"] == "image/jpeg") || ($_FILES["profile_image"]["type"] == "image/png"))){
                        // Where the file is going to be stored
                            $target_dir = "../img/";
                            $file = $_FILES['profile_image']['name'];
                            $path = pathinfo($file);
                            $filename = $path['filename'];
                            $ext = $path['extension'];
                            $tempName = $_FILES['profile_image']['tmp_name'];
                            $path_filename_ext = $target_dir.$filename.".".$ext;
                    }

                    $data =$userName.",".$hashedPassword.",".$firstName.",".$lastName.",".$email.",".$gender.",".$DOB.",".$address
                            .","."null".","."null".","."null".","."customer".","."null".",".$path_filename_ext."\n";

                    if(usernameValidate($userName)){
                        $csvFile = 'Customer.csv';
                        $fileHandle = fopen($csvFile, 'a+');
                        flock($fileHandle, LOCK_SH);
                        
                        $file = "Customer.csv";
                        $_fileHandle = fopen($file, 'r');
                        flock($_fileHandle, LOCK_SH);
                        while ($line = fgets($_fileHandle)){
                            $records[] = explode(",", $line);
                        }
                        if($_fileHandle == false){
                            die("Error opening file: ". $file);
                        }
                        flock($_fileHandle, LOCK_UN);
                        fclose($_fileHandle);
                        $userNameList = array();
                        for($i = 1; $i < count($records); $i++){    
                            array_push($userNameList, $records[$i][0]);   
                        }
                        if(isInArray($userNameList, validate($userName)) == true){
                            echo '<script>alert("Username is already registered");</script>';
                        } else {
                            fwrite($fileHandle, $data);
                            move_uploaded_file($tempName,$path_filename_ext);
                            header("Location: ../Login/login.php");
                        }

                        if($fileHandle == false){
                            die("Error opening file: ". $csvFile);
                        }
                        flock($fileHandle, LOCK_UN);
                        fclose($fileHandle);
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

                function passwordValidation($password){
                    $pattern =  '/$\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$/';

                    if(preg_match($pattern, $password)){
                        return true;
                    } 
                    return false;
                }

                function nameValidation($name){
                    $pattern = "/^[A-Za-z]{1,}$/";

                    if(preg_match($pattern, $name)){
                        return true;
                    } 
                    return false;
                }

                function emailValidation($email){
                    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                        return true;
                    }
                    return false;
                }

                function addressValidation($address){
                    $pattern = "/^\\d+ [a-zA-Z ]+, \\d+ [a-zA-Z ]+, [a-zA-Z ]+$/";

                    if(preg_match($pattern, $address)){
                        return true;
                    } 
                    return false;
                }

                function radioValidation($radio){
                    if($radio == "Man" || $radio == "Woman"){
                        return true;
                    }
                    return false;
                }
            ?>
            <div class="container">
                <form action="regis_cus.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col">
                            <label for="username">User name</label>
                            <input type="text" name="username" id="username" required>

                        </div>
                        <div class="col">
                            <label for="password">New Password</label>
                            <input type="text" name="password" id="password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="firstname">First Name</label>
                            <input type="text" name="firstname" id="firstname" required >
                        </div>
                        <div class="col">
                            <label for="lastname">Last Name</label>
                            <input type="text" name="lastname" id="lastname" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" required>
                        </div>
                        <div class="col" id="radio">
                            <label for="gender">Gender: </label>
                            <input type="radio" name="gender" id="male" value="Male" required>
                            <label for="male">Male</label>
                            <input type="radio" name="gender" id="female" value ="Female">
                            <label for="female">Female</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="DOB">Date Of Birth</label>
                            <input type="date" name="DOB" id="DOB" required>
                        </div>
                        <div class="col">
                            <label for="address">Address</label>
                            <input type="text" name="address" id="address" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="profile_image">Profile Image</label>
                            <input id="profile_image" type="file" name="profile_image" accept="image/*" required>
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