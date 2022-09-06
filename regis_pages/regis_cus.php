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
                    $userName = $_POST['username'];
                    $password = $_POST['password'];
                    $firstName = $_POST['firstname'];
                    $lastName = $_POST['lastname'];
                    $email = $_POST['email'];
                    $gender = $_POST['gender'];
                    $DOB = $_POST['DOB'];
                    $address = $_POST['address'];

                    $data =$userName.",".$password.",".$firstName.",".$lastName.",".$email.",".$gender.",".$DOB.",".$address
                            .","."null".","."null".","."customer".","."null"."\n";

                    echo usernameValidate($userName);
                    echo passwordValidation($password);
                    echo nameValidation($firstName);
                    echo emailValidation($email);
                    echo radioValidation($gender);
                    echo addressValidation($address);

                    if(usernameValidate($userName)){
                        $csvFile = 'Customer.csv';
                        $file_handle = fopen($csvFile, 'a+');
                        flock($file_handle, LOCK_SH);
                        fwrite($file_handle, $data);
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
                        header("Location: /Desktop/Web/Login/login.php");
                    }
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
                            <input type="text" name="username" id="username">
                        </div>
                        <div class="col">
                            <label for="password">New Password</label>
                            <input type="text" name="password" id="password">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="firstname">First Name</label>
                            <input type="text" name="firstname" id="firstname" >
                        </div>
                        <div class="col">
                            <label for="lastname">Last Name</label>
                            <input type="text" name="lastname" id="lastname">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email">
                        </div>
                        <div class="col" id="radio">
                            <label for="gender">Gender: </label>
                            <input type="radio" name="gender" id="man" value="Man">
                            <label for="man">Man</label>
                            <input type="radio" name="gender" id="woman" value ="Woman">
                            <label for="woman">Woman</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="DOB">Date Of Birth</label>
                            <input type="date" name="DOB" id="DOB">
                        </div>
                        <div class="col">
                            <label for="address">Address</label>
                            <input type="text" name="address" id="address">
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