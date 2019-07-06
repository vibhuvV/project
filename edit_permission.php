<?php 
    include_once "connection.php";
    $permPresent = false;

    $id = $_GET['edit-id'];
    $sql = mysqli_query($conn, "select * from permission where permissionid = '$id'");
    $info = mysqli_fetch_assoc($sql);
    if(isset($_POST['updtPerm'])){
        $permName = $_POST['permname'];
        $status = $_POST['status'];
        $sqlPerm = mysqli_query($conn, "select * from permission where permissionname = '$permName'");
        $perm = mysqli_fetch_assoc($sqlPerm);
        if(isset($perm)){
            $permPresent = true;
        }else{
            $sqlPerm1 = mysqli_query($conn, "update permission set permmissionname='$permName', status='$status' where permissionid = $id");

            if($sqlPerm1){
                header('location: http://localhost/project/permission.php');
            }
        }
    }
?>
<?php require_once "header.php"; ?>
<?php if(in_array("Permission", $permissionarray1)){ ?>
<div class="row">
    <div class="col-sm-10 offset-sm-2 text-left addUsers">
                    <h1>Edit Permissions</h1>
    </div>
    <div class="col-sm-8 offset-sm-2">
    <form id="regForm" autocomplete="off" name="regForm" action="" class="regForm" method="post" enctype="multipart/form-data">
                <h2>Registration Form</h2>
                <div class="form-group">
                    <input autocomplete="off" type="text" class="form-control form-control-lg validate[required]" name="permname" value="<?php echo $info['permissionname']; ?>">
                </div>
                <div class="form-group">
                <label for="sel1">Status:</label>
                <select class="form-control form-control-lg" name="status">
                <option value="active" selected>Active</option>
                <option value="inactive" >Inactive</option>
                </select>
                </div>
                <?php if($permPresent == true) { echo "<label>Permission already Present</label>"; } ?>
                <div class="form-group">
                    <input type="submit" class="form-control form-control-lg btn-lg btn-danger" name="updtPerm" value="Add">
                </div>
    </form>
    </div>
</div>


<?php require_once "footer.php"; ?>
<?php } ?>