<?php 
    include_once "connection.php";
    if(!isset($_SESSION['username'])){
        header('location: http://localhost/project/index.php');
    }
    $user_name = $_SESSION['username'];
    $sqlquery = mysqli_query($conn, "select * from userinfo where username = '$user_name'");
    $sqlArray = mysqli_fetch_assoc($sqlquery);
    $roleses = $sqlArray['role'];
    $sqlquery2 = mysqli_query($conn, "select * from role where rolename = '$roleses'");
    $sqlArray2 = mysqli_fetch_assoc($sqlquery2);
    $rolesesid = $sqlArray2['roleid'];
    $sqlquery3 = mysqli_query($conn, "select distinct permissionid from relation where roleid = '$rolesesid'");
    $i = 0;
    foreach($sqlquery3 as $permissionArray2){
        $pppppp = $permissionArray2['permissionid'];
        $sqlquery4 = mysqli_query($conn, "select permissionname from permission where permissionid = '$pppppp'");
        $pper = mysqli_fetch_assoc($sqlquery4);
        $permissionarray1[$i] = $pper['permissionname'];  
        $i++;
    }

?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PMS</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<!-- <script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script> -->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="style.css">
    <script>
        $(document).ready(function(){
            $("#leftmenuinner").on({
                mouseenter: function(){
                    $("#navMenu").animate({marginLeft: '10vw'}, 100),
                    $(this).animate({width: '15vw'}, 100),
                    $(".hd").toggle(50);
                },
                mouseleave: function(){
                    $("#navMenu").animate({marginLeft: '3vw'}, 100),
                    $(this).animate({width: '4vw'}, 100),
                    $(".hd").toggle(50);
                    $(".aclMenu").hide();
                    var menu = $("span#iconR i").attr('class');
                    if(menu == "fas fa-chevron-down"){
                        $("span#iconR i").removeClass("fa-chevron-down");
                        $("span#iconR i").addClass("fa-chevron-right");
                    }
                }
            });

            $("#aclm").click(function(){
                $("span#iconR i").toggleClass("fa-chevron-right");
                $("span#iconR i").toggleClass("fa-chevron-down");
                $(".aclMenu").slideToggle(50);
            });

            $(".aclMenu").on({
                mouseenter: function(){
                    $(this).css("background-color", "rgb(167, 116, 42)");
                },
                mouseleave: function(){
                    $(this).css("background-color", "#cc8e34")
                }
            });
        });
    </script>
</head>
<body>
    <div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
        <nav id="navBar" class="navbar navbar-expanded-md bg-light navbar-white fixed-top">
            <span class="navbar-brand"><a href="index.php"><i class="fas fa-industry"></i> <b id="logo">PMS</b></a> <span id="navMenu"><i class="fas fa-th-list"></i></span></span>
            <ul class="navbar-nav">
                <li class="navbar-item">
                <div class="dropdown">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" style="border: none; background: none; color: black;">
                    <img src=<?php echo "images/".$sqlArray['image']; ?> alt="<?php echo $sqlArray['image']; ?>" width="45" height="45" class="rounded-circle img-thumbnail"><sub><i style="right: 8px; position: relative; top: 10px; color: green; font-size: 8px;" class="fas fa-circle"></i></sub>
                    </button>
                    <div class="dropdown-menu" style="position: absolute;">
                        <a class="dropdown-item" href="logout.php">Log Out</a>
                    </div>
                </div>        
                </li>
            </ul>
        </nav>
        </div>
        <div id="leftmenuinner">
            <table class="table table-borderless table-hover navLeft text-center">
                <?php if(in_array("Dashboard", $permissionarray1)){ ?>
                <tr>
                    <td><i class="fas fa-tachometer-alt"></i></td>
                    <td class="hd text-left" style="display:none;"><a href="dashboard.php">Dashboard</a></td>
                </tr>
                <?php } ?>
                <?php if(in_array("Permission", $permissionarray1)){ ?>
                <tr id="aclm">
                    <td><i class="fab fa-adn"></i></td>
                    <td class="hd text-left" style="display:none;">ACL &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="iconR"><i class="fas fa-chevron-right" ></i></span></td>
                </tr>
                <?php } ?>
                <?php if(in_array("Users", $permissionarray1)){ ?>
                <tr class="aclMenu" style="display: none; background-color: #cc8e34;">
                    <td></td>
                    <td class="text-left"><a href="user.php"><i class="fas fa-users"></i> &nbsp;&nbsp;Users</a></td>
                </tr>
                <?php } ?>
                <?php if(in_array("Role", $permissionarray1)){ ?>
                <tr class="aclMenu" style="display: none; background-color: #cc8e34;">
                    <td></i></td>
                    <td class="text-left"><a href="role.php"><i class="fas fa-user-tag"></i> &nbsp;&nbsp;Role</a></td>
                </tr>
                <?php } ?>
                <?php if(in_array("Permission", $permissionarray1)){ ?>
                <tr class="aclMenu" style="display: none; background-color: #cc8e34;">
                    <td></td>
                    <td class="text-left"><a href="permission.php"><i class="far fa-eye"></i> &nbsp;&nbsp;Permission</a></td>
                </tr>
                <?php } ?>
                <?php if(in_array("Project", $permissionarray1)){ ?>
                <tr>
                    <td><i class="fas fa-project-diagram"></i></td>
                    <td class="hd text-left" style="display:none;"><a href="project.php">Projects</a></td>
                </tr>
                <?php } ?>
                <?php if(in_array("Revenue", $permissionarray1)){ ?>
                <tr>
                    <td><i class="fas fa-pencil-alt"></i></td>
                    <td class="hd text-left" style="display:none;"><a href="revenue.php">Revenue</a></td>
                </tr>
                <?php } ?>
                <?php if(in_array("Timesheet", $permissionarray1)){ ?>
                <tr>
                    <td><i class="fas fa-calendar-minus"></i></td>
                    <td class="hd text-left" style="display:none;"><a href="timesheet.php">Time Sheet</a></td>
                </tr>
                <?php } ?>
            </table>
        </div>
        <div class="mainContainer outer">
