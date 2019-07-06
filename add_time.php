<?php 
    include_once "connection.php"; 

    $name = $_SESSION["username"];
    $sql = mysqli_query($conn, "select * from userinfo where username='$name'");
    $check = mysqli_fetch_assoc($sql);
    $userID1 = $check['userid'];
    $userRole = $check['role'];

    if(isset($_POST['setttime'])){
        $logintime = $_POST['logintime'];
        $logouttime = $_POST['logouttime'];
        $date = $_POST['date'];
        $comments = $_POST['comments'];
        $userid = $_POST['userid'];
        if($userRole == 'admin'){
            $sqlUpdateTime = mysqli_query($conn, "insert into datetimerec(logintime, logouttime, logindate, comments, userid) values('$logintime', '$logouttime', '$date', '$comments', '$userid')");
        }else{
            $sqlUpdateTime = mysqli_query($conn, "insert into datetimerec(logintime, logouttime, logindate, comments, userid) values('$logintime', '$logouttime', '$date', '$comments', '$userID1')");
        }
        if($sqlUpdateTime){
            header('location: http://localhost/project/timesheet.php');
        }
    }

?>

<?php require_once "header.php"; ?>
<div class="row">
    <div class="col-sm-10 offset-sm-2 text-left addUsers">
                    <h1>Add Time</h1>
    </div>
    <div class="col-sm-8 offset-sm-2">
    <form id="regForm" autocomplete="off" name="regForm" action="" class="regForm" method="post" enctype="multipart/form-data">
                <h2>Time Add</h2>
                <div class="form-group">
                    <input type="<?php if($userRole == 'admin') {echo "text";}else{echo "hidden";} ?>" class="form-control form-control-lg" name="userid" placeholder="User Id">
                </div>
                <div class="form-group">
                <label>Login Time:</label>
                    <input type="time" class="form-control form-control-lg" name="logintime">
                </div>
                <div class="form-group">
                <label>Logout Time:</label>
                    <input type="time" class="form-control form-control-lg" name="logouttime">
                </div>
                <div class="form-group">
                <label>Date:</label>
                    <input type="date" class="form-control form-control-lg" name="date">
                </div>
                <div class="form-group">
                <label>Comments:</label>
                    <textarea class="form-control" rows="5" name="comments"></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" class="form-control form-control-lg btn-lg btn-danger" name="setttime" value="Insert">
                </div>
    </form>
    </div>
</div>
<?php require_once "footer.php"; ?>