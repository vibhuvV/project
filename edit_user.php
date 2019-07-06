<?php 
    include_once "connection.php";
    $roleCount = true;
    $permCount = true;
    $sqlRole = mysqli_query($conn, "select * from role");
    $role = mysqli_fetch_assoc($sqlRole);
    $sqlPerm = mysqli_query($conn, "select * from permission");
    $perm = mysqli_fetch_assoc($sqlPerm);
    if(isset($perm) && isset($role)){
        $roleCount = false;
        $permCount = false;
    }
    
    $id = $_GET['edit-id'];
    $sqlInfo = mysqli_query($conn, "select * from userinfo where userid = '$id'");
    $info = mysqli_fetch_assoc($sqlInfo);

    $file_invalid = false;
    $file_invalid_size = false;
    $count = true;
    if(isset($_POST['update'])){
        $allowed_image_extension = array("png", "jpg", "jpeg");
        $file_extention = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $name = $_POST['name'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $encPassword = md5($password);
        $image = $_FILES['image']['name'];
        $role = $_POST['role'];
        $status = $_POST['status'];
        if(empty($role)){
            $role = "none";
        }
        if(empty($image)){
            $image = $info['image'];
        }
        if ($_FILES["image"]["size"] > 1100000) {
            $file_invalid_size = true;
        }
        
        if($file_invalid_size == false){
        $dir = $_SERVER['DOCUMENT_ROOT']."/project";
        $path = $dir."/images";
        move_uploaded_file($_FILES['image']['tmp_name'], $path."/".$_FILES['image']['name']);

        $sql = mysqli_query($conn, "update userinfo set name='$name', email='$email', username='$username', password='$encPassword', role='$role', status='$status', image='$image' where userid = '$id'");
        
        $sqlFetRol = mysqli_query($conn, "select roleid from role where rolename = '$role'");
        $roleidAr = mysqli_fetch_assoc($sqlFetRol);
        $roleid = $roleidAr['roleid'];
        $sqlFet = mysqli_query($conn, "select permissionid from relation where roleid = '$roleid'");
        foreach($sqlFet as $yo){
            $pid = $yo['permissionid'];
            $relation = mysqli_query($conn, "insert into relation(userid, permissionid, roleid) select * from (select '$id', '$pid', '$roleid') as temp where not exists (select userid, roleid, permissionid from relation where userid = '$id' and permissionid = '$pid' and roleid = '$roleid')");
        }


        if($sql){
            $_SESSION['update'] = "User details updated";
            header("location: http://localhost/project/user.php");
        }

        }
    }
?>


<?php require_once "header.php"; ?>
<?php if(in_array("Users", $permissionarray1)){ ?>


<div class="row">
    <div class="col-sm-10 offset-sm-2 text-left addUsers">
                    <h1>Edit Users</h1>
    </div>
    <div class="col-sm-8 offset-sm-2">
    <form id="regForm" autocomplete="off" name="regForm" action="" class="regForm" method="post" enctype="multipart/form-data">
                <h2>Edit Form</h2>
                <div class="form-group">
                    <input autocomplete="off" type="text" class="form-control form-control-lg validate[required]" name="name" value="<?php echo $info['name']; ?>">
                </div>
                <div class="form-group">
                    <input id="email" type="email" class="form-control form-control-lg validate[required]" name="email" value="<?php echo $info['email']; ?>" autocomplete="off">
                </div>
                <div class="form-group">
                    <input autocomplete="off" type="text" class="form-control form-control-lg validate[required]" name="username" value="<?php echo $info['username']; ?>">
                </div>
                <div class="form-group">
                    <input id="password" type="password" autocomplete="off" class="form-control form-control-lg validate[required]" name="password" value="<?php echo $info['password']; ?>">
                </div>
                <div class="form-group">
                <label for="sel1">Role:</label>
                <select class="form-control form-control-lg" id="sel1" name="role">
                <?php 
                    if($role){
                        foreach($sqlRole as $roleList){
                ?>
                <?php if($roleList['status'] == "active" || $roleList['status'] == "Active") { ?>
                <option value="<?php echo $roleList['rolename']; ?>" <?php if($info['role'] == $roleList['rolename']) echo "selected"; ?>><?php echo $roleList['rolename']; ?></option>
                <?php } ?>
                <?php
                        }}
                ?>
                </select>
                </div>
                <div class="form-group">
                <label for="sel1">Status:</label>
                <select class="form-control form-control-lg" id="sel1" name="status">
                <option value="active" selected>Active</option>
                <option value="Inactive" >Inactive</option>
                </select>
                </div>
                <div class="form-group">
                <div class="row">
                <div class="col-sm-8">
                    <input type="file" style="padding: 5px;" class="form-control-file form-control-lg border validate[required]" name="image">
                </div>
                <div class="col-sm-4">
                    <img src=<?php echo "images/".$info['image']; ?> alt="<?php echo $info['image']; ?>" width="100" height="100" class="rounded-circle">
                    <label><?php echo $info['image']; ?></label>
                </div>
                </div>
                </div>
                <?php
                        if($file_invalid_size == true){
                            echo "<label>File is too large to upload</label>";
                        }
                ?>
                <div class="form-group">
                    <input type="submit" class="form-control form-control-lg btn-lg btn-danger" name="update" value="update">
                </div>
            </form>
    </div>
</div>



<?php require_once "footer.php"; ?>
<?php } ?>