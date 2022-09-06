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
                    while ($line = fgets($file_handle))
                        $records[] = explode(",", $line);
                    if($file_handle == false){
                        die("Error opening file: ". $file);
                    }
                    flock($file_handle, LOCK_UN);
                    fclose($file_handle);
                    for($i = 1; $i < count($records); $i++){
                        for($j = 0; $j < 12; $j++){
                            $uName = $records[$i][0];
                            $password = $records[$i][1];
                            $role = $records[$i][10];
                            if(isset($_POST['login-btn'])){
                                if(isset($_username) == $uName && isset($_hashed_password) == $password){
                                    if($role == "customer"){
                                        header("Location: ../Customer_pages/Customer_home_page.html");
                                    } elseif ($role == "vendor"){
                                        header("Location: ../vendors_page/view_my_products.html");
                                    } elseif ($role == "shipper"){
                                        header("Location: #");
                                    }
                                } else {
                                    header("Location: login.php");
                                }
    
                                if(empty($_username)){
                                    header("Location: login.php?error = Username is required");
                                    exit();
                                } elseif (empty($_password)){
                                    header("Location: login.php?erro = Password is required");
                                    exit();
                                }
                            }
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
                            <input type="text" name="username" id="username">
                        </div>
                       <div class="col">
                            <label for="password">Password</label> <br>
                            <input type="password" name="password" id="username">
                       </div>
                       <form action="login.php" method="post">
                       <div class="col">
                            <button class="btn" name="login-btn">
                                <a href="#">Log in</a>
                            </button>
                       </div>
                       </form>
                    </form>
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