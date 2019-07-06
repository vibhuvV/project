<?php
    include_once "connection.php";
    if(isset($_GET['delete-id'])){
        $delId = $_GET['delete-id'];
        $del = mysqli_query($conn, "delete from datetimerec where id = '$delId'");
        if($del){
            header('location: http://localhost/project/timesheet.php');
        }
    }
    $name = $_SESSION["username"];
    $sql = mysqli_query($conn, "select * from userinfo where username='$name'");
    $check = mysqli_fetch_assoc($sql);
    $userID1 = $check['userid'];
    $userRole = $check['role'];
    if($userRole == 'admin'){
        $sql = mysqli_query($conn, "select * from datetimerec");
    }else{
        $sql = mysqli_query($conn, "select * from datetimerec where userid = $userID1");
    }
?>

<?php require_once "header.php"; ?>
<?php if(in_array("Timesheet", $permissionarray1)){ ?>
<div class="row">
                <div class="col-sm-2 text-left addUsers">
                    <h1>Timesheet</h1>
                </div>
                <div class="col-sm-2 offset-sm-8 text-right addUsers">
                    <a href="add_time.php" class="btn btn-primary btn-lg btnAdd"> + Add Time</a>
                </div>
                <div class="col-sm-12">
                    <div class="tabOuter">
                    <table class="table table-hover">
                        <tr class="table-info">
                            <td colspan="9" height="85"><h2>Timesheet</h2></td>
                        </tr>
                        <tr class="text-center">
                            <th>User Id</th>
                            <th>Login Time</th>
                            <th>Logout Time</th>
                            <th>Date</th>
                            <th>Comments</th>
                            <th>Action</th>
                        </tr>
                        <?php foreach($sql as $timesheet){ ?>
                        <tr class="text-center">
                            <td><?php echo $timesheet['userid']; ?></td>
                            <td><?php echo $timesheet['logintime']; ?></td>
                            <td><?php echo $timesheet['logouttime']; ?> </td>
                            <td><?php echo $timesheet['logindate']; ?> </td>
                            <td><?php echo $timesheet['comments']; ?> </td>
                            <td><a href="edit_time.php?edit-id=<?php echo $timesheet['id']?>">Edit/</a><a href="?delete-id=<?php echo $timesheet['id']?>">Delete</a></td>
                        </tr>
                        <?php } ?>
                    </table>
                    </div>
                </div>
            </div>
<script>
$(document).ready(function(){
    $("td").addClass("align-middle");
});
</script>

<?php require_once "footer.php"; ?>
<?php } ?>