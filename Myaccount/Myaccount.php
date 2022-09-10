<?php
    session_start();
?>
<!DOCTYPE html>

<html>
    <head>
        <?php require '../php_scripts/general_head.php'?>
    </head>
    <body>
        <header>
            <?php require '../php_scripts/general_header.php'?>
        </header>
        <section class="my-account">
            <?php
                if (isset($_POST['log_out'])){
                    unset($_SESSION["current_user"]);
                    session_destroy();
                    header("Location: ../Login/login.php");
                }
                echo '<h1>My Account ('.$_SESSION['current_user']['role'].')</h1>';
            ?>
            <div class="container">
                <?php
                    $_avatarLink = "";
                    $file = "../regis_pages/Customer.csv";
                    $records =[];
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
                    for($j = 0; $j <count($records); $j++){
                        if($records[$j][0] == $_SESSION['current_user']['username']){
                            $_avatarLink = $records[$j][13];
                        }
                    }
                    if(isset($_POST['submit'])){
                        $file = " ";
                        $path_filename_ext = $_SESSION["current_user"]["imageURL"];
                        $temp_name = " ";
                        if (($_FILES['profile_image']['name']!="" && $_FILES['profile_image']['size'] < 15000
                            && ($_FILES['profile_image']['type'] == "image/jpg") || ($_FILES["profile_image"]["type"] == "image/jpeg") || ($_FILES["profile_image"]["type"] == "image/png"))){
                            // Where the file is going to be stored
                            $target_dir = "../img/";
                            $file = $_FILES['profile_image']['name'];
                            $path = pathinfo($file);
                            $filename = $path['filename'];
                            echo $filename;
                            $ext = $path['extension'];
                            $temp_name = $_FILES['profile_image']['tmp_name'];
                            $path_filename_ext = $target_dir.$filename.".".$ext;
                            $csvFile = "../regis_pages/Customer.csv";
                            $file_handle = fopen($csvFile, "w");
                            flock($file_handle, LOCK_SH);
                            
                            for($i = 0; $i < count($records); $i++){
                                if($records[$i][0] == $_SESSION['current_user']['username']){
                                    $records[$i][13] = $path_filename_ext."\n";
                                }
                            }
                            foreach($records as $user){
                                $userStr = implode(",",$user);
                                fwrite($file_handle, $userStr);
                            }
                            
                            move_uploaded_file($temp_name,$path_filename_ext);
                            $_SESSION["current_user"]["imageURL"] = $path_filename_ext;
                            flock($file_handle, LOCK_UN);
                            fclose($file_handle);
                            header("Location: Myaccount.php");
                        } else {
                            echo '<script>alert("File size is too big or the image type is not jpeg/jpg/png");</script>';
                        }
                    }
                        
                    echo '<div class = "chosen-file"><img width="300px" src="'.$_SESSION["current_user"]["imageURL"].'" alt="profile-picture"></div>';
                ?>
                    <div class="information">
                        <?php
                            switch ($_SESSION['current_user']['role']) {
                                case "customer":
                                    echo '
                                    <div class="row">
                                        <div class="username">
                                            Username: <span>'.$_SESSION['current_user']['username'].'</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="name">Name: <span> '.$_SESSION['current_user']['firstname'].' '.$_SESSION['current_user']['lastname'].'</span>
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class="DOB">
                                            Date Of Birth: <span>'.$_SESSION['current_user']['DOB'].'</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="Address">Email: <span>'.$_SESSION['current_user']['email'].'</span></div>
                                    </div>
                                    <div class="row">
                                        <div class="Address">Address: <span>'.$_SESSION['current_user']['address'].'</span></div>
                                    </div>
                                    <div class="row">
                                        <div class="gender">Gender: <span>'.$_SESSION['current_user']['gender'].'</span></div>
                                    </div>
                                    ';
                                    break;
                                case "vendor":
                                    echo '
                                    <div class="row">
                                        <div class="username">
                                            Username: <span>'.$_SESSION['current_user']['username'].'</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="name">Business Name: <span> '.$_SESSION['current_user']['business-name'].'</span>
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class="Business-address">Business Address: <span>'.$_SESSION['current_user']['business-address'].'</span></div>
                                    </div>                              
                                    ';
                                    break;
                                case "shipper":
                                    echo '
                                    <div class="row">
                                        <div class="username">
                                            Username: <span>'.$_SESSION['current_user']['username'].'</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="name">Name: <span> '.$_SESSION['current_user']['firstname'].' '.$_SESSION['current_user']['lastname'].'</span>
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class="age">
                                            Age: <span>'.$_SESSION['current_user']['age'].'</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="hub">Distribution Hub: <span>'.$_SESSION['current_user']['distribution_hub'].'</span></div>
                                    </div>
                                    ';
                                    break;
                                default:
                                    echo 'Sorry, something wrong happened, please register again';
                                    break;
                            }
                        ?>
                    <form action="Myaccount.php" method="post" enctype="multipart/form-data">
                        <div class ="profile_image" style="margin-left:10px;">
                            <label for="profile_image">Profile Image</label>
                            <input id="profile_image" type="file" name="profile_image" accept="image/*">
                        </div>
                        <input style="width: 100px; font-size: 80%; margin-left:10px;" type="submit" name="submit" value="Save Change" id="submit">
                    </div>
                    </div>
                    <div class="btn">
                        <button name="log_out" value="true">Log Out</button>
                    </div>
                    </form>
        </section>
        <?php require '../php_scripts/general_footer.php'?>

    </body>
    <script src="../resources/js/preview_img.js"></script>
</html>