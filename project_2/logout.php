<?php
include('server.php');
$logout = $_GET["logout"];
$sql = "DELETE FROM log WHERE user = '$logout'";
$result = mysqli_query($conn,$sql);

if($result){
    header("location:login2.php");
}


?>