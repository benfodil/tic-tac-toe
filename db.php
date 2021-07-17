<?php
$host = "localhost"; // Your DB HOST
$user = "root"; // Your DB User
$pass = "root"; // Your DB Password
$db_name = "xo"; // Your DB Name
$connect = @mysqli_connect("$host","$user","$pass","$db_name");
mysqli_query($connect,"SET NAMES 'utf8'");
mysqli_query($connect,'SET CHARACTER SET utf8');
?>