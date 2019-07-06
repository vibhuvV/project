<?php 
    include_once "connection.php";
    $name = $_SESSION["username"];
    $sql = mysqli_query($conn, "select * from userinfo where username='$name'");
    $check = mysqli_fetch_assoc($sql);
    $userID1 = $check['userid'];
    $userRole = $check['role'];
    $timeinsert = mysqli_query($conn, "update datetimerec set logouttime = now() where userid = $userID1 order by id desc");
    session_unset();
    session_destroy();
    header('location: http://localhost/project/index.php');
?>