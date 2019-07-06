<?php
    include_once "connection.php";
    if(isset($_GET['delete-id'])){
        $delId = $_GET['delete-id'];
        $del = mysqli_query($conn, "delete from userinfo where userid = '$delId'");
        if($del){
            header('location: http://localhost/project/user.php');
        }
    }
    
    $sql = mysqli_query($conn, "select * from userinfo");
?>

<?php require_once "header.php"; ?>
<?php if(in_array("Users", $permissionarray1)){ ?>
    <?php if(isset($_SESSION['update'])){
                $alertMsg = $_SESSION['update'];
                echo "<div class=\"alert alert-success fade in alert-dismissible show align-middle\"><strong> $alertMsg </strong><button type=\"button\" class=\"close align-middle\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\" style=\"font-size:20px\">&times;</span></button> </div>";
                unset($_SESSION['update']);
            } ?>
            <div class="row">
                <div class="col-sm-2 text-left addUsers">
                    <h1>Users</h1>
                </div>
                <div class="col-sm-2 offset-sm-8 text-right addUsers">
                    <a href="add_user.php" class="btn btn-primary btn-lg btnAdd"> + Add Users</a>
                </div>
                <div class="col-sm-12">
                    <div class="tabOuter">
                    <table class="table table-hover">
                        <tr class="table-info">
                            <td colspan="9" height="85"><h2>Users</h2></td>
                        </tr>
                        <tr class="text-center">
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>DP</th>
                            <th>Edit/Delete</th>
                        </tr>
                        <?php foreach($sql as $data){ ?>
                        <tr class="text-center">
                            <td><?php echo $data['userid']; ?></td>
                            <td><?php echo $data['name']; ?></td>
                            <td><?php echo $data['email']; ?></td>
                            <td><?php echo $data['username']; ?></td>
                            <td><?php echo $data['password']; ?></td>
                            <td><?php echo $data['role']; ?></td>
                            <td><?php echo $data['status']; ?> </td>
                            <td><img src=<?php echo "images/".$data['image']; ?> alt="<?php echo $data['image']; ?>" width="50" height="50" class="rounded-circle"></td>
                            <td><a href="edit_user.php?edit-id=<?php echo $data['userid'];?>">Edit/</a><a href="?delete-id=<?php echo $data['userid'];?>">Delete</a></td>
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