<?php 
    include_once "connection.php";
    $sqlManage = mysqli_query($conn, "select * from userinfo where role = 'manager'");
    $editId = $_GET['edit-id'];
    $sqlEdit = mysqli_query($conn, "select * from projects where id = $editId");
    $managerEditList = mysqli_fetch_assoc($sqlEdit);

    if(isset($_POST['updtProject'])){
        $projName = $_POST['projectname'];
        $startDate = $_POST['startdate'];
        $endDate = $_POST['enddate'];
        $status = $_POST['status'];
        $budget = $_POST['budget'];
        $manager = $_POST['manager'];

        $sqlAddManager = mysqli_query($conn, "update projects set projectname = '$projName', startDate = '$startDate', enddate = '$endDate', status = '$status', budget = '$budget', managerallocated = '$manager' where id = $editId");

        if($sqlAddManager){
            header('location: http://localhost/project/project.php');
        }
        
    }
?>
<?php require_once "header.php"; ?>
<?php if(in_array("Permission", $permissionarray1)){ ?>
<div class="row">
    <div class="col-sm-10 offset-sm-2 text-left addUsers">
                    <h1>Add Projects</h1>
    </div>
    <div class="col-sm-8 offset-sm-2">
    <form id="regForm" autocomplete="off" name="regForm" action="" class="regForm" method="post" enctype="multipart/form-data">
                <h2>Add Project Details</h2>
                <div class="form-group">
                <label>Project Name:</label>
                    <input autocomplete="off" type="text" class="form-control form-control-lg" name="projectname" placeholder="Project Name" value="<?php echo $managerEditList['projectname']; ?>">
                </div>
                <div class="form-group">
                <label>Start Date: </label>
                    <input autocomplete="off" type="date" class="form-control form-control-lg" name="startdate" placeholder="Start Date" value="<?php echo $managerEditList['startdate']; ?>">
                </div>
                <div class="form-group">
                <label>End Date: </label>
                    <input autocomplete="off" type="date" class="form-control form-control-lg" name="enddate" placeholder="End Date" value="<?php echo $managerEditList['enddate']; ?>">
                </div>
                <div class="form-group">
                <label>Status:</label>
                <select class="form-control form-control-lg" name="status">
                <option value="active" <?php if($managerEditList['status'] == 'active') echo "selected"; ?>>Active</option>
                <option value="inactive" <?php if($managerEditList['status'] == 'inactive') echo "selected"; ?>>Inactive</option>
                </select>
                </div>
                <div class="form-group">
                <label>Budget:</label>
                    <input autocomplete="off" type="text" class="form-control form-control-lg" name="budget" placeholder="Budget in Rs." value="<?php echo $managerEditList['budget']; ?>">
                </div>
                <div class="form-group">
                <label>Manager To Allocate:</label>
                <select class="form-control form-control-lg" name="manager">
                <?php foreach($sqlManage as $managerList){ ?>
                <option value="<?php echo $managerList['name']; ?>" <?php if($managerEditList['managerallocated'] == $managerList['name']){echo "selected";} ?>><?php echo $managerList['name']; ?></option>
                <?php } ?>
                </select>
                </div>
                <div class="form-group">
                    <input type="submit" class="form-control form-control-lg btn-lg btn-danger" name="updtProject" value="Update">
                </div>
    </form>
    </div>
</div>


<?php require_once "footer.php"; ?>
<?php } ?>