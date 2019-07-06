<?php 
    include_once "connection.php";
    $sqlPro = mysqli_query($conn, "select * from projects");
    $editId = $_GET['edit-id'];
    $sqlEdit = mysqli_query($conn, "select * from revenue where id = $editId");
    $revenueEditList = mysqli_fetch_assoc($sqlEdit);

    if(isset($_POST['updtRevenue'])){
        $projId = $_POST['projectid'];
        $invoiceAmount = $_POST['invoiceamount'];
        $dateCreated = $_POST['datecreated'];
        $status = $_POST['status'];

        $sqlAddManager = mysqli_query($conn, "update revenue set projectid = '$projId', invoiceamount = '$invoiceAmount', datecreated = '$dateCreated', status = '$status' where id = $editId");

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
                        <option value="<?php echo $projectIdList['id']; ?>" <?php if($projectIdList['id'] == $revenueEditList['projectid']) echo "selected"; ?>><?php echo $projectIdList['id']; ?></option>
                    <?php } ?>
                </select>
                </div>
                <div class="form-group">
                <label>Invoice Amount: </label>
                    <input autocomplete="off" type="text" class="form-control form-control-lg" name="invoiceamount" placeholder="Invoice Amount" value="<?php echo $revenueEditList['invoiceamount']; ?>">
                </div>
                <div class="form-group">
                <label>Date Created: </label>
                    <input autocomplete="off" type="date" class="form-control form-control-lg" name="datecreated" value="<?php echo $revenueEditList['datecreated']; ?>">
                </div>
                <div class="form-group">
                <label for="sel1">Status:</label>
                <select class="form-control form-control-lg" name="status">
                <option value="pending" <?php if($revenueEditList['status'] == 'pending') echo "selected"; ?>>Pending</option>
                <option value="paid" <?php if($revenueEditList['status'] == 'paid') echo "selected"; ?>>Paid</option>
                </select>
                </div>
                <div class="form-group">
                    <input type="submit" class="form-control form-control-lg btn-lg btn-danger" name="updtRevenue" value="Add">
                </div>
    </form>
    </div>
</div>


<?php require_once "footer.php"; ?>
<?php } ?>