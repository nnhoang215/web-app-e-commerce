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
        <section class="login-form">
            <h1>Log In</h1>
                <?php 
                    error_reporting(0);
                    $records = array();
                    $_username = validate($_POST['username']);
                    $_password = validate($_POST['password']);
                    $_hashed_password = password_hash($_password, PASSWORD_DEFAULT);
                    $file = "../regis_pages/Customer.csv";
                    $file_handle = fopen($file, 'r');
                    flock($file_handle, LOCK_SH);
                    while ($line = fgets($file_handle)){
                        $records[] = explode(",", $line);}
                    if($file_handle == false){
                        die("Error opening file: ". $file);
                    }
                    flock($file_handle, LOCK_UN);
                    fclose($file_handle);
                    for($i = 1; $i < count($records); $i++){
                        for($j = 0; $j < 13; $j++){
                            $uName = $records[$i][0];
                            $password = $records[$i][1];
                            $role = $records[$i][11];
                            if(isset($_POST['login-btn'])){
                                if($_username == $uName && password_verify($_password, $password)){                                   
                                    $currentUser = array(
                                        "username" => $records[$i][0],
                                        "firstname" => $records[$i][2],
                                        "lastname" => $records[$i][3],
                                        "email" => $records[$i][4],
                                        "gender" => $records[$i][5],
                                        "DOB" => $records[$i][6],
                                        "address" => $records[$i][7],
                                        "business-name" => $records[$i][8],
                                        "business-address" => $records[$i][9],
                                        "age" => $records[$i][10],
                                        "role" => $records[$i][11],
                                        "distribution_hub" => $records[$i][12],
                                        "imageURL" => $records[$i][13]                            
                                    );
                                    $_SESSION["current_user"] = $currentUser;
                                    
                                    if($role == "customer"){
                                        header("Location: ../Customer_pages/Customer_home_page.php");
                                    } elseif ($role == "vendor"){
                                        header("Location: ../vendors_page/view_my_products.php");
                                    } elseif ($role == "shipper"){
                                        header("Location: ../shipper_pages/shipper_main_page.php");
                                    } else {
                                        print_r("Login error");
                                    }
                                    break 2;
                                }

                                if(empty($_username)){
                                    header("Location: login.php?error = Username is required");
                                    exit();
                                } elseif (empty($_password)){
                                    header("Location: login.php?error = Password is required");
                                    exit();
                                }
                            }
                        }
                    }
                    if ($_username != ""){
                        if (!isset($_SESSION['current_user'])) {
                            echo '<script>alert("Wrong username or password");</script>';
                        }
                    }

                    function validate($data){

                        $data = trim($data);
                 
                        $data = stripslashes($data);
                 
                        // $data = htmlspecialchars($data);
                 
                        return $data;
                 
                    }

                ?>
                <div class="container">
                    <form action="login.php" method="post">
                        <div class="col">
                            <label for="username">Username</label> <br>
                            <input type="text" name="username" id="username" required>
                        </div>
                       <div class="col">
                            <label for="password">Password</label> <br>
                            <input type="password" name="password" id="username" required>
                       </div>
                       <form action="login.php" method="post">
                       <div class="col">
                            <button class="btn" name="login-btn" value="true">
                                <a>Log in</a>
                            </button>
                       </div>
                       </form>
                    </form>
                </div>
                <div class="registration-prompt">
                    Don't have an account? <a href='../regis_pages/regis_role.php'>Create</a> one!
                </div>
        </section>
        <?php require '../php_scripts/general_footer.php'?>

    </body>
</html>