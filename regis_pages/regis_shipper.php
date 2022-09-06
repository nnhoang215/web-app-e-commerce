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
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $age = $_POST['age'];
                    $distributionHub = $_POST['distribution-hub'];

                    $information = $userName.",".$password.","."null".","."null".","."null".","."null".","."null"
                    .","."null".","."null".",".$age.","."shipper".",".$distributionHub."\n";

                    if(usernameValidate($userName)){
                        $csvFile = 'Customer.csv';
                        $file_handle = fopen($csvFile, 'a+');
                        flock($file_handle, LOCK_SH);
                        fwrite($file_handle, $information);
                        if($file_handle == false){
                            die("Error opening file: ". $csvFile);
                        }
                        flock($file_handle, LOCK_UN);
                        fclose($file_handle);
                
                        // header("Location: /Desktop/Web/Login/login.php");
                    }
                }
            ?>
            <div class="container">
                <form action="regis_customer.php" method="post">
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
                            </select>
                        </div>
                    </div>
                    <div class="submit-container">
                        <input type="submit" id="submit" name="submit">
                    </div>
                </form>
            </div>
            <div class="product-img-input">
                    <form action="regis_cus.php" method="post" enctype="multipart/form-data">
                    <div class="chosen-file">
                        <img src="#profile-image" alt="chosen file">
                        <p>No file chosen</p>
                    </div>
                    <input id="profile-image" type="file" name="profile-image">
                    <h4>Note:</h4>
                    <p>Image can be uploaded of any dimension but we reccomend you to 
                        upload image with dimension of 1024x1024 & its size must be less than 15MB.
                    </p>
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