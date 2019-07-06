<?php 
    include_once "connection.php";
    $rolePresent = false;
    $permCount = true;
    $sqlPerm = mysqli_query($conn, "select * from permission");
    $perm = mysqli_fetch_assoc($sqlPerm);

    $id = $_GET['edit-id'];
    $sql = mysqli_query($conn, "select * from role where roleid = '$id'");
    $sqlarr = mysqli_fetch_assoc($sql);

    if(!isset($perm)){
        $permCount = false;
    }
    if(isset($_POST['updtRole'])){
        $rolePresent = false;
        $roleName = $_POST['rolename'];
        $status = $_POST['status'];
            $sqlRole = mysqli_query($conn, "update role set rolename='$roleName', status='$status' where roleid = $id");

            $sqlRoleId = mysqli_query($conn, "select roleid from role where rolename = '$roleName'");
            $arr = mysqli_fetch_assoc($sqlRoleId);
            $roleID = $arr['roleid'];        
            $permissions = $_POST['permissions'];
            if(!empty($permissions)){
            foreach($permissions as $permid){
                $sqlP = mysqli_query($conn, "select permissionid from permission where permissionname = '$permid'");
                $pfetch = mysqli_fetch_assoc($sqlP);
                $pID = $pfetch['permissionid'];
                $relation = mysqli_query($conn, "insert into relation(permissionid, roleid) select * from (select '$pID', '$roleID') as temp where not exists (select roleid, permissionid from relation where permissionid = '$pID' and roleid = '$roleID')");
            }}
            if($sqlRole){
                header('location: http://localhost/project/role.php');
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
                    <input autocomplete="off" type="text" class="form-control form-control-lg validate[required]" name="rolename" value="<?php echo $sqlarr['rolename']; ?>">
                </div>
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
                    <input type="submit" class="form-control form-control-lg btn-lg btn-danger" name="updtRole" value="Update">
                </div>
            </form>
    </div>
</div>


<?php require_once "footer.php"; ?>
<?php } ?>