<?php
include_once 'config.php';
$username = $_POST['username'];
$password = $_POST['password'];
$sql = "SELECT COUNT(`username`) AS `count` FROM `users` WHERE username='$username' and password='$password'";
//echo $sql;
$result = $con->query($sql);
$emptyarray = array();
$emptyarray[] = mysqli_fetch_assoc($result);
echo json_encode($emptyarray);

