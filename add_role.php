<?php 
    include_once "connection.php";
    $rolePresent = false;
    $permCount = true;
    $sqlPerm = mysqli_query($conn, "select * from permission");
    $perm = mysqli_fetch_assoc($sqlPerm);
    if(!isset($perm)){
        $permCount = false;
    }
    if(isset($_POST['addRole'])){
        $rolePresent = false;
        $roleName = $_POST['rolename'];
        $status = $_POST['status'];
        $sqlCheck = mysqli_query($conn, "select * from role where rolename = '$roleName'");
        $chck = mysqli_fetch_array($sqlCheck);
        if(!isset($chck)){
            $sqlRole = mysqli_query($conn, "insert into role(rolename, status) values('$roleName', '$status')");

            $sqlRoleId = mysqli_query($conn, "select roleid from role where rolename = '$roleName'");
            $arr = mysqli_fetch_assoc($sqlRoleId);
            $roleID = $arr['roleid'];        
            $permissions = $_POST['permissions'];
            foreach($permissions as $permid){
                $sqlP = mysqli_query($conn, "select permissionid from permission where permissionname = '$permid'");
                $pfetch = mysqli_fetch_assoc($sqlP);
                $pID = $pfetch['permissionid'];
                $relation = mysqli_query($conn, "insert into relation(permissionid, roleid) values('$pID', '$roleID')");
            }
            if($sqlRole){
                header('location: http://localhost/project/role.php');
            }
        }else{
            $rolePresent = true;
        }

    }
?>
<?php require_once "header.php"; ?>
<?php if(in_array("Role", $permissionarray1)){ ?>
<div class="row">
    <div class="col-sm-10 offset-sm-2 text-left addUsers">
                    <h1>Add Roles</h1>
    </div>
    <div class="col-sm-8 offset-sm-2">
    <form id="regForm" autocomplete="off" name="regForm" action="" class="regForm" method="post" enctype="multipart/form-data">
                <h2>Registration Form</h2>
                <div class="form-group">
                    <input autocomplete="off" type="text" class="form-control form-control-lg validate[required]" name="rolename" placeholder="Role Name">
                </div>
                <?php if($rolePresent){ echo "<label>This role is already present</label>"; } ?>
                <div class="form-group">
                <label for="sel1">Permissions:</label>
                <select multiple class="form-control form-control-lg" name="permissions[]">
                <?php if($permCount == true){
                            foreach($sqlPerm as $permList){
                ?>
                <?php if($permList['status'] == "active" || $permList['status'] == "Active") { ?>
                <option value="<?php echo $permList['permissionname']; ?>"><?php echo $permList['permissionname']; ?></option>
                <?php } ?>
                            <?php }} ?>
                </select>
                </div>
                <div class="form-group">
                <label for="sel1">Status:</label>
                <select class="form-control form-control-lg" name="status">
                <option value="active" selected>Active</option>
                <option value="Inactive" >Inactive</option>
                </select>
                </div>
                <div class="form-group">
                    <input type="submit" class="form-control form-control-lg btn-lg btn-danger" name="addRole" value="Add">
                </div>
            </form>
    </div>
</div>


<?php require_once "footer.php"; ?>
                            <?php } ?>