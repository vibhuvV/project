<?php
    include_once "connection.php";
    if(isset($_GET['delete-id'])){
        $delId = $_GET['delete-id'];
        $del = mysqli_query($conn, "delete from revenue where id = '$delId'");
        if($del){
            header('location: http://localhost/project/revenue.php');
        }
    }

    $revenueCount = true;
    $sqlRevenue = mysqli_query($conn, "select * from revenue");
    $reven = mysqli_fetch_assoc($sqlRevenue);
    if(!isset($reven)){
        $revenueCount = false;
    }

    
?>
<?php require_once "header.php"; ?>
<?php if(in_array("Revenue", $permissionarray1)){ ?>
<div class="row">
                <div class="col-sm-2 text-left addUsers">
                    <h1>Revenue</h1>
                </div>
                <div class="col-sm-2 offset-sm-8 text-right addUsers">
                    <a href="add_revenue.php" class="btn btn-primary btn-lg btnAdd"> + Add Bill</a>
                </div>
                <div class="col-sm-12">
                    <div class="tabOuter">
                    <table class="table table-hover">
                        <tr class="table-info">
                            <td colspan="9" height="85"><h2>Invoices</h2></td>
                        </tr>
                        <tr class="text-center">
                            <th>Project ID</th>
                            <th>Invoice Amount</th>
                            <th>Date Created</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        <?php
                            if($revenueCount){
                                foreach($sqlRevenue as $revenueList){
                        ?>
                        <tr class="text-center">
                            <td><?php echo $revenueList['projectid']; ?></td>
                            <td><?php echo "&#8377; ".$revenueList['invoiceamount']; ?></td>
                            <td><?php echo $revenueList['datecreated']; ?></td>
                            <td><?php echo $revenueList['status']; ?></td>
                            <td><a href="edit_revenue.php?edit-id=<?php echo $revenueList['id'];?>">Edit/</a><a href="?delete-id=<?php echo $revenueList['id'];?>">Delete</a></td>
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
<?php } ?>
<?php require_once "footer.php"; ?>