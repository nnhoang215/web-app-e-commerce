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
                error_reporting(0);
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
                    $address = str_replace(array(' , ',', ',' ,',','),'-',$_POST['address']);
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
                            $data =$userName.",".$hashedPassword.",".$firstName.",".$lastName.",".$email.",".$gender.",".$DOB.",".$address
                            .","."null".","."null".","."null".","."customer".","."null".",".$path_filename_ext."\n";

                        if(usernameValidate($userName) && passwordValidation($password) && firstNameValidation($firstName) 
                        && lastNameValidation($lastName) && emailValidation($email) && addressValidation($address)){
                            $csvFile = 'accounts.csv';
                            $fileHandle = fopen($csvFile, 'a+');
                            flock($fileHandle, LOCK_SH);
                            
                            $file = "accounts.csv";
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
                                header("Location: ../../index.php");
                            }

                            if($fileHandle == false){
                                die("Error opening file: ". $csvFile);
                            }
                            flock($fileHandle, LOCK_UN);
                            fclose($fileHandle);
                            unset($_SESSION["file_error"]);
                        } else {
                            echo '<script>alert("username: contains only letters (lower and upper case) and digits, has a length from 8 to 15 characters, unique
                            password: contains at least one upper case letter, at least one lower case letter, at least one digit, at least one special letter in the set !@#$%^&*, NO other kind of characters, has a length from 8 to 20 characters
                            Other fields are required and have a minimum length of 5 characters (except the profile picture, which is a file upload, and the shipper\'s distribution hub, which is a drop-down select)");</script>';
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
                    $pattern = '/^[A-Za-z0-9]{8,15}$/';

                    if(preg_match($pattern,$userName)){
                        return true;
                    }
                    return false;
                }

                function passwordValidation($password){
                    $pattern1 =  '/[a-z]/';
                    $pattern2 =  '/[A-Z]/';
                    $pattern3 =  '/[0-9]/';
                    $pattern4 =  '/[\!\@\#\$\%\^\&\*]/';

                    if(preg_match($pattern1, $password)
                    &&preg_match($pattern2, $password)
                    &&preg_match($pattern3, $password)
                    &&preg_match($pattern4, $password)
                    && strlen($password) >= 8 && strlen($password) <= 20){
                        return true;
                    }
                    return false;
                }
           

                function firstNameValidation($name){
                    if(strlen($name)>=5){
                        return true;
                    } 
                    return false;
                }
              
                function lastNameValidation($name){
                    if(strlen($name)>=5){
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
                    if(strlen($address)>=5){
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
                            <input type="password" name="password" id="password" required>
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
                            <input type="text" name="address" id="address" placeholder="00 Street-District-City" required>
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
        <?php require '../php_scripts/general_footer.php'?>
        <script src="../../JavaScript/preview_img.js"></script>
    </body>
</html>