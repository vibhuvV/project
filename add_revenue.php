<?php 
    include_once "connection.php";
    $sqlPro = mysqli_query($conn, "select * from projects");
    if(isset($_POST['addRevenue'])){
        $projId = $_POST['projectid'];
        $invoiceAmount = $_POST['invoiceamount'];
        $dateCreated = $_POST['datecreated'];
        $status = $_POST['status'];

        $sqlAddManager = mysqli_query($conn, "insert into revenue(projectid, invoiceamount, datecreated, status) values('$projId', '$invoiceAmount', '$dateCreated', '$status')");

        if($sqlAddManager){
            header('location: http://localhost/project/revenue.php');
        }
        
    }
?>
<?php require_once "header.php"; ?>
<?php if(in_array("Revenue", $permissionarray1)){ ?>
<div class="row">
    <div class="col-sm-10 offset-sm-2 text-left addUsers">
                    <h1>Add Projects</h1>
    </div>
    <div class="col-sm-8 offset-sm-2">
    <form id="regForm" autocomplete="off" name="regForm" action="" class="regForm" method="post" enctype="multipart/form-data">
                <h2>Add Invoice Details</h2>
                <div class="form-group">
                <label>Project Id:</label>
                <select class="form-control form-control-lg" name="projectid">
                    <?php foreach($sqlPro as $projectIdList){ ?>
                        <option value="<?php echo $projectIdList['id']; ?>"><?php echo $projectIdList['id']; ?></option>
                    <?php } ?>
                </select>
                </div>
                <div class="form-group">
                    <input autocomplete="off" type="text" class="form-control form-control-lg" name="invoiceamount" placeholder="Invoice Amount">
                </div>
                <div class="form-group">
                <label>Date Created: </label>
                    <input autocomplete="off" type="date" class="form-control form-control-lg" name="datecreated">
                </div>
                <div class="form-group">
                <label for="sel1">Status:</label>
                <select class="form-control form-control-lg" name="status">
                <option value="pending" selected>Pending</option>
                <option value="paid" >Paid</option>
                </select>
                </div>
                <div class="form-group">
                    <input type="submit" class="form-control form-control-lg btn-lg btn-danger" name="addRevenue" value="Add">
                </div>
    </form>
    </div>
</div>


<?php require_once "footer.php"; ?>
<?php } ?>