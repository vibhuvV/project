<?php 
    include_once "connection.php";
    $sqlManage = mysqli_query($conn, "select * from userinfo where role = 'manager'");
    $permPresent = false;
    if(isset($_POST['addProject'])){
        $projName = $_POST['projectname'];
        $startDate = $_POST['startdate'];
        $endDate = $_POST['enddate'];
        $status = $_POST['status'];
        $budget = $_POST['budget'];
        $manager = $_POST['manager'];

        $sqlAddManager = mysqli_query($conn, "insert into projects(projectname, startdate, enddate, status, budget, managerallocated) values('$projName', '$startDate', '$endDate', '$status', '$budget', '$manager')");

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
                    <input autocomplete="off" type="text" class="form-control form-control-lg" name="projectname" placeholder="Project Name">
                </div>
                <div class="form-group">
                <label>Start Date: </label>
                    <input autocomplete="off" type="date" class="form-control form-control-lg" name="startdate" placeholder="Start Date">
                </div>
                <div class="form-group">
                <label>End Date: </label>
                    <input autocomplete="off" type="date" class="form-control form-control-lg" name="enddate" placeholder="End Date">
                </div>
                <div class="form-group">
                <label for="sel1">Status:</label>
                <select class="form-control form-control-lg" name="status">
                <option value="active" selected>Active</option>
                <option value="inactive" >Inactive</option>
                </select>
                </div>
                <div class="form-group">
                    <input autocomplete="off" type="text" class="form-control form-control-lg" name="budget" placeholder="Budget in Rs.">
                </div>
                <div class="form-group">
                <label>Manager To Allocate:</label>
                <select class="form-control form-control-lg" name="manager">
                <?php foreach($sqlManage as $managerList){ ?>
                <option value="<?php echo $managerList['name']; ?>"><?php echo $managerList['name']; ?></option>
                <?php } ?>
                </select>
                </div>
                <div class="form-group">
                    <input type="submit" class="form-control form-control-lg btn-lg btn-danger" name="addProject" value="Add">
                </div>
    </form>
    </div>
</div>


<?php require_once "footer.php"; ?>
<?php } ?>