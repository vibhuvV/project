<?php
    include_once "connection.php";
    $file_invalid = false;
    $file_invalid_size = false;
    $file_empty = false;
    $count = true;
    $usernameExists = false;
    if(isset($_POST['submit'])){
        $allowed_image_extension = array("png", "jpg", "jpeg");
        $file_extention = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $name = $_POST['name'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $encPassword = md5($password);
        $image = $_FILES['image']['name'];
        $role = "none";
        $status = "inactive";

        if(! in_array($file_extention, $allowed_image_extension)){
            $file_invalid = true;
        }
        if ($_FILES["image"]["size"] > 1100000) {
            $file_invalid_size = true;
        }
        if ($image == ""){
            $file_empty = true;
        }

        if($file_invalid == false && $file_invalid_size == false && $file_empty == false){
        $dir = $_SERVER['DOCUMENT_ROOT']."/project";
        $path = $dir."/images";
        move_uploaded_file($_FILES['image']['tmp_name'], $path."/".$_FILES['image']['name']);
        $sqlExists = mysqli_query($conn, "select username from userinfo");
        $iE = 0;
        foreach($sqlExists as $arrTemp){
            $arrUser[] = $arrTemp['username'];
            $iE++;        
        }
        if(in_array($username, $arrUser)){
            $usernameExists = true;
        }else{
            $sql = mysqli_query($conn, "insert into userinfo(name, email, username, password, role, status, image) values('$name', '$email', '$username', '$encPassword', '$role', '$status', '$image')");
            if($sql){
                $count = true;
                header('location: http://localhost/project/index.php');
            }
        }
    }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PMS | Sign Up</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="jQuery-Validation/css/validationEngine.jquery.css" type="text/css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="jQuery-Validation/js/languages/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
    <script src="jQuery-Validation/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="style.css">
    <script>
		jQuery(document).ready(function(){
			jQuery("#regForm").validationEngine();
		});
    </script>
</head>
<body class="bgImage">
<div class="container">
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <div class="headerText text-center">
            <h1 style="font-size: 4em;"><i class="fas fa-industry"></i> Project Management System</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <form id="regForm" autocomplete="off" name="regForm" action="" class="regForm" method="post" enctype="multipart/form-data">
                <h2>Registration Form</h2>
                <div class="form-group">
                    <input autocomplete="off" type="text" class="form-control form-control-lg validate[required]" name="name" placeholder="Name">
                </div>
                <div class="form-group">
                    <input id="email" type="email" class="form-control form-control-lg validate[required]" name="email" placeholder="E-mail" autocomplete="off">
                </div>
                <div class="form-group">
                    <input id="confirm_email" autocomplete="off" type="email" class="form-control form-control-lg validate[required]" name="Cemail" placeholder="Confirm E-mail">
                </div>
                <div class="form-group">
                <?php if($usernameExists == true){ echo "<div class=\"alert alert-danger\">Username exists</div>"; } ?>
                    <input autocomplete="off" type="text" class="form-control form-control-lg validate[required]" name="username" placeholder="Username">
                </div>
                <div class="form-group">
                    <input id="password" type="password" autocomplete="off" class="form-control form-control-lg validate[required]" name="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <input id="confirm_password" type="password" class="form-control form-control-lg validate[required]" autocomplete="off" name="Cpassword" placeholder="Confirm Password">
                </div>
                <div class="form-group">
                    <input type="file" style="padding: 5px;" class="form-control-file form-control-lg border validate[required]" name="image">
                </div>
                <?php
                        if($file_empty == true){
                            echo "<label>File is empty</label>";
                        }
                        if($file_invalid == true){
                            echo "<label>File is invalid. Only .png .jpg files are allowed</label>";
                        }
                        if($file_invalid_size == true){
                            echo "<label>File is too large to upload</label>";
                        }
                ?>
                <div class="form-group">
                    <input type="submit" class="form-control form-control-lg btn-lg btn-danger" name="submit" value="Sign Up">
                </div>
                <div class="form-group">
                    <label id="signUpPage">Already a member? <a href="index.php">Sign In</a></label>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
var password = document.getElementById("password"), confirm_password = document.getElementById("confirm_password");
var email = document.getElementById("email"), confirm_email = document.getElementById("confirm_email");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

function validateEmail(){
  if(email.value != confirm_email.value) {
    confirm_email.setCustomValidity("Emails Don't Match");
  } else {
    confirm_email.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
email.onchange = validateEmail;
confirm_email.onkeyup = validateEmail;
</script>
</body>
</html>