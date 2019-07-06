<?php
    include_once "connection.php";
    $counter = true;
    $wrong = false;
    if(isset($_POST['login'])){
    $_SESSION["username"] = $_POST['username'];
    $name = $_SESSION["username"];
    $password = $_POST['password'];
    $encPassword = md5($password);
    $sql = mysqli_query($conn, "select * from userinfo where username='$name' and password='$encPassword'");
    $check = mysqli_fetch_assoc($sql);
    $status = $check['status'];
    $userID1 = $check['userid'];
    if(isset($check) && $status == "active" || $status == "Active"){
        $com = "";
        $timeinsert = mysqli_query($conn, "insert into datetimerec(logintime, logindate, userid) values(now(), now(), $userID1)");
        header('location: http://localhost/project/dashboard.php');
    }else{
        $counter = false;
        $wrong = true;
    }

}

?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PMS | Login</title>
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
			jQuery("#login").validationEngine();
		});
    </script>
</head>
<?php if(!isset($_SESSION['username']) || $counter == false ){ ?>
<body class="bgImage">
<div class="container">
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <div class="headerText text-center">
            <h1 style="font-size: 4em;"><i class="fas fa-industry"></i> Project Management System</h1>
            </div>
        </div>
    </div>
    <div class="row pamplet">
        <div class="col-sm-5 offset-1 sidePamplet">
            <img class="sideImage" src="sideImage.png" width="200" height="200" alt="login image">
        </div>
        <div class="col-sm-5 sideLine">
            <form id="login" action="" class="loginForm" method="post">
                <h2>Login Form</h2>
                <div class="form-group input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control" name="username" placeholder="Username">
                </div>
                <div class="form-group input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <div class="form-group">
                <?php
                    if($wrong == true){
                        echo "<label>Wrong Username or Password or may be you'r account is not activated</label>";
                    }
                ?>
                    <input type="submit" class="form-control btn btn-danger" name="login" value="Login">
                </div>
                <div class="form-group">
                    <label id="signUpPage">New here? <a href="signup.php">Sign Up</a></label>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
<?php }else{header('location: http://localhost/project/dashboard.php');} ?>
</html>