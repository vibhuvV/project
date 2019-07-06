<?php
    include_once "connection.php";
    if(isset($_GET['delete-id'])){
        $delId = $_GET['delete-id'];
        $del = mysqli_query($conn, "delete from role where roleid = '$delId'");
        if($del){
            header('location: http://localhost/project/role.php');
        }
    }
    $roleCount = true;
    $permCount = true;
    $sqlRole = mysqli_query($conn, "select * from role");
    $role = mysqli_fetch_assoc($sqlRole);
    $sqlPerm = mysqli_query($conn, "select * from permission");
    $perm = mysqli_fetch_assoc($sqlPerm);
    if(!isset($perm) && !isset($role)){
        $roleCount = false;
        $permCount = false;
    }
?>

<?php require_once "header.php"; ?>
<?php if(in_array("Role", $permissionarray1)){ ?>
<div class="row">
                <div class="col-sm-2 text-left addUsers">
                    <h1>Roles</h1>
                </div>
                <div class="col-sm-2 offset-sm-8 text-right addUsers">
                    <a href="add_role.php" class="btn btn-primary btn-lg btnAdd"> + Add Roles</a>
                </div>
                <div class="col-sm-12">
                    <div class="tabOuter">
                    <table class="table table-hover">
                        <tr class="table-info">
                            <td colspan="9" height="85"><h2>Roles</h2></td>
                        </tr>
                        <tr class="text-center">
                            <th>Role</th>
                            <th>Permissions</th>
                            <th>Status</th>
                            <th>Edit/Delete</th>
                        </tr>
                        <?php
                            if($roleCount && $permCount){
                                foreach($sqlRole as $roleList){
                        ?>
                        <tr class="text-center">
                            <td><?php echo $roleList['rolename']; ?></td>
                            <?php
                                $roleListid = $roleList['roleid']; 
                                $sqlFet = mysqli_query($conn, "select distinct permissionid from relation where roleid = '$roleListid'");
                                $permn = "";
                                foreach($sqlFet as $yo){
                                    $id = $yo['permissionid'];
                                    $sqlPermission = mysqli_query($conn, "select permissionname from permission where permissionid = '$id'");
                                    foreach($sqlPermission as $permname){
                                        $permission = $permname['permissionname'];
                                    }
                                    $permn .= $permission .", ";
                                }
                            ?>
                            <td><?php echo $permn; ?></td>
                            <td><?php echo $roleList['status']; ?> </td>
                            <td><a href="edit_role.php?edit-id=<?php echo $roleList['roleid']?>">Edit/</a><a href="?delete-id=<?php echo $roleList['roleid']?>">Delete</a></td>
                        </tr>
                            <?php }} ?>
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