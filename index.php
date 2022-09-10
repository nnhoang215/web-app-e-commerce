<?php
    session_start();
?>
<!DOCTYPE html>

<html>
    <head>
        <title>Shopee E-com</title>
        <link rel="stylesheet" href="./CSS/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="./CSS/queries.css">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
    </head>
    <body>
        <header>
        <?php
            $_redirectLink = isset($_SESSION["current_user"]) ? "./PHP/Myaccount/Myaccount.php" : "index.php";
            $_homePageLink = "index.php";

            if (isset($_SESSION["current_user"])) {
                switch ($_SESSION["current_user"]["role"]) {
                case "customer":
                    $_homePageLink = "./PHP/Customer_pages/Customer_home_page.php";
                    break;
                case "vendor":
                    $_homePageLink = "./PHP/vendors_page/view_my_products.php";
                    break;
                case "shipper":
                    $_homePageLink = "./PHP/shipper_pages/shipper_main_page.php";
                    break;
                }
            }
            $_login = isset($_SESSION["current_user"]) ? "Welcome, ".$_SESSION['current_user']['username']."!" : "<li><a href=".$_redirectLink.">Log in</a></li>";

            echo 
            '<nav>
                <div class="nav-bar">
                    <div class="logo-name">
                        <a href="index.php"><img src="./PHP/img/shopee_logo.png" alt="logo"></a>
                        <p><a href="index.php">The world\'s biggest E-commerce application</a></p>
                    </div>
                    <div class="nav">
                        <ul>
                            <li><a href="'.$_homePageLink.'">Home</a></li>
                            <li><a href="'.$_redirectLink.'">My Account</a></li>
                            '.$_login.'
                        </ul>
                    </div>
                </div>
            </nav>';
        ?>
        </header>
        <section class="login-form">
            <h1>Log In</h1>
                <?php 
                    error_reporting(0);
                    $records = array();
                    $_username = validate($_POST['username']);
                    $_password = validate($_POST['password']);
                    $_hashed_password = password_hash($_password, PASSWORD_DEFAULT);
                    $file = "./PHP/regis_pages/accounts.csv";
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
                                        header("Location: ./PHP/Customer_pages/Customer_home_page.php");
                                    } elseif ($role == "vendor"){
                                        header("Location: ./PHP/vendors_page/view_my_products.php");
                                    } elseif ($role == "shipper"){
                                        header("Location: ./PHP/shipper_pages/shipper_main_page.php");
                                    } else {
                                        print_r("Login error");
                                    }
                                    break 2;
                                }

                                if(empty($_username)){
                                    header("Location: index.php?error = Username is required");
                                    exit();
                                } elseif (empty($_password)){
                                    header("Location: index.php?error = Password is required");
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
                    <form action="index.php" method="post">
                        <div class="col">
                            <label for="username">Username</label> <br>
                            <input type="text" name="username" id="username" required>
                        </div>
                       <div class="col">
                            <label for="password">Password</label> <br>
                            <input type="password" name="password" id="username" required>
                       </div>
                       <form action="index.php" method="post">
                       <div class="col">
                            <button class="btn" name="login-btn" value="true">
                                <a>Log in</a>
                            </button>
                       </div>
                       </form>
                    </form>
                </div>
                <div class="registration-prompt">
                    Don't have an account? <a href='./PHP/regis_pages/regis_role.php'>Create</a> one!
                </div>
        </section>
        <footer>
            <ul>
                <li><a href="./PHP/sub-pages/About.php">About</a></li>
                <li><a href="./PHP/sub-pages/Copyright.php">Copyright</a></li>
                <li><a href="./PHP/sub-pages/Policy.php">Policy</a></li>
                <li><a href="./PHP/sub-pages/Helpslink.php">Helps link</a></li>
            </ul>
        </footer>
    </body>
</html>