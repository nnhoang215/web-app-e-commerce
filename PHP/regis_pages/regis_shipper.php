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
                    $userName = $_POST['username'];
                    $password = $_POST['password'];
                    $firstName = $_POST['first-name'];
                    $lastName = $_POST['last-name'];
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
                            $information = $userName.",".$hashed_password.",".$firstName.",".$lastName.","."null".","."null".","."null".","."null"
                            .","."null".","."null".",".$age.","."shipper".",".$distributionHub.",".$path_filename_ext."\n";
        
                            if(usernameValidate($userName) && passwordValidation($password) && firstNameValidation($firstName)
                                && lastNameValidation($lastName)){
                                $csvFile = 'accounts.csv';
                                $file_handle = fopen($csvFile, 'a+');
                                flock($file_handle, LOCK_SH);
                                
                                $file = "accounts.csv";
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
                                    echo '<script>alert("Username is already registered");</script>';
                                } else {
                                    fwrite($file_handle, $information);
                                    move_uploaded_file($temp_name,$path_filename_ext);
                                    header("Location: ../../index.php");
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
                <form action="regis_shipper.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col">
                            <label for="username">User name</label>
                            <input type="text" name="username" id="username">
                        </div>
                        <div class="col">
                            <label for="password">New Password</label>
                            <input type="password" name="password" id="password">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="first-name">First Name:</label>
                            <input type="text" name="first-name" id="first-name" required>
                        </div>
                        <div class="col">
                            <label for="last-name">Last Name: </label>
                            <input type="text" name="last-name" id="last-name" required>
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
                            <input id="profile_image" type="file" accept="iamge/*" name="profile_image">
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