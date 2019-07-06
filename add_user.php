<?php 
    include_once "connection.php";
    $roleCount = true;
    $permCount = true;
    $usernameExists = false;
    $sqlRole = mysqli_query($conn, "select * from role");
    $role = mysqli_fetch_assoc($sqlRole);
    $sqlPerm = mysqli_query($conn, "select * from permission");
    $perm = mysqli_fetch_assoc($sqlPerm);
    if(isset($perm) && isset($role)){
        $roleCount = false;
        $permCount = false;
    } 

    $file_invalid = false;
    $file_invalid_size = false;
    $file_empty = false;
    $count = true;
    if(isset($_POST['add'])){
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
        if(! in_array($file_extention, $allowed_image_extension)){
            $file_invalid = true;
        }
        if ($_FILES["image"]["size"] > 5000000) {
            $file_invalid_size = true;
        }
        if ($image == ""){
            $file_empty = true;
        }

        if($file_invalid == false && $file_invalid_size == false && $file_empty == false){
            $dir = $_SERVER['DOCUMENT_ROOT']."/project";
            $path = $dir."/images";
            move_uploaded_file($_FILES['image']['tmp_name'], $path."/".$_FILES['image']['name']);
            $sqlExists = mysqli_query($conn, "select username from userinfo");
            $iE = 0;
            foreach($sqlExists as $arrTemp){
                $arrUser[] = $arrTemp['username'];
                $iE++;        
            }
            if(in_array($username, $arrUser)){
                $usernameExists = true;
            }else{
                $sql = mysqli_query($conn, "insert into userinfo(name, email, username, password, role, status, image) values('$name', '$email', '$username', '$encPassword', '$role', '$status', '$image')");
                $sql1 = mysqli_query($conn, "select userid from userinfo where username = '$username'");
                $sqlid = mysqli_fetch_assoc($sql1);
                $id = $sqlid['userid'];
                $sqlFetRol = mysqli_query($conn, "select roleid from role where rolename = '$role'");
                $roleidAr = mysqli_fetch_assoc($sqlFetRol);
                $roleid = $roleidAr['roleid'];
                $sqlFet = mysqli_query($conn, "select permissionid from relation where roleid = '$roleid'");
                foreach($sqlFet as $yo){
                    $pid = $yo['permissionid'];
                    $relation = mysqli_query($conn, "insert into relation(userid, permissionid, roleid) values('$id', '$pid', '$roleid')");
                }

                if($sql){
                    header("location: http://localhost/project/user.php");
                }
            }
        }
    }
?>
<?php require_once "header.php"; ?>
<?php if(in_array("Users", $permissionarray1)){ ?>
<div class="row">
    <div class="col-sm-10 offset-sm-2 text-left addUsers">
                    <h1>Add Users</h1>
    </div>
    <div class="col-sm-8 offset-sm-2">
    <form id="regForm" autocomplete="off" name="regForm" action="" class="regForm" method="post" enctype="multipart/form-data">
                <h2>Registration Form</h2>
                <div class="form-group">
                    <input autocomplete="off" type="text" class="form-control form-control-lg validate[required]" name="name" placeholder="Name">
                </div>
                <div class="form-group">
                    <input id="email" type="email" class="form-control form-control-lg validate[required]" name="email" placeholder="E-mail" autocomplete="off">
                </div>
                <div class="form-group">
                    <?php if($usernameExists == true){ echo "<div class=\"alert alert-danger\">Username exists</div>"; } ?>
                    <input autocomplete="off" type="text" class="form-control form-control-lg validate[required]" name="username" placeholder="Username">
                </div>
                <div class="form-group">
                    <input id="password" type="password" autocomplete="off" class="form-control form-control-lg validate[required]" name="password" placeholder="Password">
                </div>
                <div class="form-group">
                <label for="sel1">Role:</label>
                <select class="form-control form-control-lg" id="sel1" name="role">
                <?php 
                    if($role){
                        foreach($sqlRole as $roleList){
                ?>
                <?php if($roleList['status'] == "active" || $roleList['status'] == "Active") { ?>
                <option value="<?php echo $roleList['rolename']; ?>"><?php echo $roleList['rolename']; ?></option>
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
                    <input type="file" style="padding: 5px;" class="form-control-file form-control-lg border validate[required]" name="image">
                </div>
                <?php
                        if($file_empty == true){
                            echo "<label>File is empty</label>";
                        }
                        if($file_invalid == true){
                            echo "<label>File is invalid. Only .png .jpg files are allowed</label>";
                        }
                        if($file_invalid_size == true){
                            echo "<label>File is too large to upload</label>";
                        }
                ?>
                <div class="form-group">
                    <input type="submit" class="form-control form-control-lg btn-lg btn-danger" name="add" value="Add">
                </div>
            </form>
    </div>
</div>


<?php require_once "footer.php"; ?>
<?php } ?>