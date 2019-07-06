<?php
    include_once "connection.php";
    if(isset($_GET['delete-id'])){
        $delId = $_GET['delete-id'];
        $del = mysqli_query($conn, "delete from permission where permissionid = '$delId'");
        if($del){
            header('location: http://localhost/project/permission.php');
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
<?php if(in_array("Permission", $permissionarray1)){ ?>
<div class="row">
                <div class="col-sm-2 text-left addUsers">
                    <h1>Permissions</h1>
                </div>
                <div class="col-sm-2 offset-sm-8 text-right addUsers">
                    <a href="add_permissions.php" class="btn btn-primary btn-lg btnAdd"> + Add Permissions</a>
                </div>
                <div class="col-sm-12">
                    <div class="tabOuter">
                    <table class="table table-hover">
                        <tr class="table-info">
                            <td colspan="9" height="85"><h2>Permissions</h2></td>
                        </tr>
                        <tr class="text-center">
                            <th>Permission ID</th>
                            <th>Permissions</th>
                            <th>Status</th>
                            <th>Edit/Delete</th>
                        </tr>
                        <?php
                            if($permCount){
                                foreach($sqlPerm as $permList){
                        ?>
                        <tr class="text-center">
                            <td><?php echo $permList['permissionid']; ?></td>
                            <td><?php echo $permList['permissionname']; ?></td>
                            <td><?php echo $permList['status']; ?> </td>
                            <td><a href="edit_permission.php?edit-id=<?php echo $permList['permissionid'];?>">Edit/</a><a href="?delete-id=<?php echo $permList['permissionid'];?>">Delete</a></td>
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