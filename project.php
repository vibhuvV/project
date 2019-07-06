<?php
    include_once "connection.php";
    if(isset($_GET['delete-id'])){
        $delId = $_GET['delete-id'];
        $del = mysqli_query($conn, "delete from project where id = '$delId'");
        if($del){
            header('location: http://localhost/project/project.php');
        }
    }

    if(isset($_GET['end-id'])){
        $endId = $_GET['end-id'];
        $sqlProjFetch = mysqli_query($conn, "select * from projects where id = $endId");
        $projId = mysqli_fetch_assoc($sqlProjFetch);
        if($projId['status'] == 'active' || $projId['status'] == 'Active'){
            $end = mysqli_query($conn, "update projects set enddate = now(), status = 'inactive' where id = '$endId'");
            if($end){
                header('location: http://localhost/project/project.php');
            }
        }else{header('location: http://localhost/project/project.php');}
    }

    $projectCount = true;
    $sqlProject = mysqli_query($conn, "select * from projects");
    $proj = mysqli_fetch_assoc($sqlProject);
    if(!isset($proj)){
        $projectCount = false;
    }

    
?>
<?php require_once "header.php"; ?>
<?php if(in_array("Project", $permissionarray1)){ ?>
<div class="row">
                <div class="col-sm-2 text-left addUsers">
                    <h1>Projects</h1>
                </div>
                <div class="col-sm-2 offset-sm-8 text-right addUsers">
                    <a href="add_projects.php" class="btn btn-primary btn-lg btnAdd"> + Add Projects</a>
                </div>
                <div class="col-sm-12">
                    <div class="tabOuter">
                    <table class="table table-hover">
                        <tr class="table-info">
                            <td colspan="9" height="85"><h2>Permissions</h2></td>
                        </tr>
                        <tr class="text-center">
                            <th>Project ID</th>
                            <th>Project Names</th>
                            <th>Start Date</th>
                            <th>End date</th>
                            <th>Status</th>
                            <th>Budget</th>
                            <th>Manager Allocated</th>
                            <th>End</th>
                            <th>Action</th>
                        </tr>
                        <?php
                            if($projectCount){
                                foreach($sqlProject as $projectList){
                        ?>
                        <tr class="text-center">
                            <td><?php echo $projectList['id']; ?></td>
                            <td><?php echo $projectList['projectname']; ?></td>
                            <td><?php echo $projectList['startdate']; ?></td>
                            <td><?php echo $projectList['enddate']; ?></td>
                            <td><?php echo $projectList['status']; ?></td>
                            <td><?php echo "&#8377; ".$projectList['budget']; ?></td>
                            <td><?php echo $projectList['managerallocated']; ?></td>
                            <td><a href="?end-id=<?php echo $projectList['id'];?>" class="btn btn-sm btn-primary">End</a></td>
                            <td><a href="edit_project.php?edit-id=<?php echo $projectList['id'];?>">Edit/</a><a href="?delete-id=<?php echo $projectList['id'];?>">Delete</a></td>
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