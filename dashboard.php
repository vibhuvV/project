<?php require_once "header.php"; ?>
<?php
    include_once "connection.php";
    $yearlyProjects = array();
    $sqlYear = mysqli_query($conn, "select year(startdate) as years, count(projectname) as totalprojects from projects group by year(startdate)");
    foreach($sqlYear as $projectYear){
        array_push($yearlyProjects, array("label" => $projectYear['years'], "y" => $projectYear['totalprojects']));
    }


    $projectArr = array();
    $sql = mysqli_query($conn, "select * from projects where year(startdate) = year(date(now()))");
    foreach($sql as $project){
        array_push($projectArr, array("label"=>$project['projectname'], "y"=>$project['budget']));
    }
?>
<?php if(in_array("Dashboard", $permissionarray1)){ ?>
<script type="text/javascript">
window.onload = function(){
    var chart = new CanvasJS.Chart("chartContainer", {
        theme: "light1",
        animationEnabled: true,
        title:{
            text: "Projects"
        },
        data: [
            {
                type: "column",
                name: "Projects",
                showInLegend: true,
                dataPoints: <?php echo json_encode($projectArr, JSON_NUMERIC_CHECK); ?>
            }
        ],
        axisY: {
            prefix: "₹"
        },
        axisX: {
            labelAngle: 0
        }
    });

    chart.render();

    var chart2 = new CanvasJS.Chart("chartContainer1", {
        theme: "light1",
        animationEnabled: true,
        title:{
            text: "Projects Yearly"
        },
        data: [
            {
                type: "line",
                name: "Years",
                showInLegend: true,
                dataPoints: <?php echo json_encode($yearlyProjects, JSON_NUMERIC_CHECK); ?>
            }
        ],
        axisX: {
            labelAngle: 0
        }
    });

    chart2.render();
}
</script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<div class="row">
    <div class="col-sm-12">
        <h1 style="margin: 1%;">Dashboard</h1>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
            <div id="chartContainer" style="height: 500px;width: 101.4%;margin-top: 15%;border: 20px white solid;border-radius: 10px;box-shadow: 0px 0px 10px 0px;"></div>
    </div>
    <div class="col-sm-6">
            <div id="chartContainer1" style="height: 500px;width: 101.4%;margin-top: 15%;border: 20px white solid;border-radius: 10px;box-shadow: 0px 0px 10px 0px;"></div>
    </div>
</div>
<?php require_once "footer.php"; ?>
<?php } ?>