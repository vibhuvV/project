<?php 
    include_once "connection.php"; 
    $id = $_GET['edit-id'];
    $sql = mysqli_query($conn, "select * from datetimerec where id = $id");
    $datetime = mysqli_fetch_assoc($sql);

    if(isset($_POST['updttime'])){
        $logintime = $_POST['logintime'];
        $logouttime = $_POST['logouttime'];
        $date = $_POST['date'];
        $comments = $_POST['comments'];

        $sqlUpdateTime = mysqli_query($conn, "update datetimerec set logintime = '$logintime', logouttime = '$logouttime', logindate = '$date', comments = '$comments' where id = $id");

        if($sqlUpdateTime){
            header('location: http://localhost/project/timesheet.php');
        }
    }
?>


<?php require_once "header.php"; ?>
<style>
.datepicker > .datepicker_header > .icon-close {
    position: absolute;
    display: block;
    width: 27px;
    height: 16px;
    vertical-align: middle;
    /* padding: 8px; */
    top: 0;
    right: 0;
}
</style>
<div class="row">
    <div class="col-sm-10 offset-sm-2 text-left addUsers">
                    <h1>Edit Time</h1>
    </div>
    <div class="col-sm-8 offset-sm-2">
    <form id="regForm" autocomplete="off" name="regForm" action="" class="regForm" method="post" enctype="multipart/form-data">
                <h2>Time Edit</h2>
                <div class="form-group">
                <label>Login Time:</label>
                    <input type="time" class="form-control form-control-lg" name="logintime" value="<?php echo $datetime['logintime'] ?>">
                </div>
                <div class="form-group">
                <label>Logout Time:</label>
                    <input type="time" id="logouttime" class="form-control form-control-lg" name="logouttime" value="<?php echo $datetime['logouttime'] ?>">
                </div>
                <div class="form-group">
                <label>Date:</label>
                    <input type="date" class="form-control form-control-lg" name="date" value="<?php echo $datetime['logindate'] ?>">
                </div>
                <div class="form-group">
                <label>Comments:</label>
                    <textarea class="form-control" rows="5" name="comments"><?php echo $datetime['comments'] ?></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" class="form-control form-control-lg btn-lg btn-danger" name="updttime" value="Update">
                </div>
    </form>
    </div>
</div>
<?php require_once "footer.php"; ?>