<?php
include_once '../config.php';
$username = $_POST['username'];
$password = $_POST['password'];
$sql = "SELECT COUNT(`username`) AS `count`,`A`, `AB`, `ABC`, `phone`,`agent_money_lsk1`,`agent_money_lsk2`,`agent_money_lsk3`,`agent_money_lsk4`,`agent_money_lsk5`,`agent_money_lsk6`,`agent_money_box1`,`agent_money_box2`,`agent_money_ab`,`agent_money_a`,TIMEDIFF( DATE_FORMAT( CONVERT_TZ( NOW( ) , '-05:30', '+00:00' ) , '%H:%i:%s' ) , DATE_FORMAT( cut_time, '%H:%i:%s' ) ) AS difference,resume_time FROM `agents`,`configuration` WHERE username='$username' and password='$password'";
$result = $con->query($sql);
$count = mysqli_num_rows($result);
$emptyarray = array();
$time_difference_row = mysqli_fetch_assoc($result);
$emptyarray[] = $time_difference_row;
if (strpos($time_difference_row['difference'], '-') !== false) {
   $emptyarray[]= array('time_status' => "0");
} else {
    $time_difference_query2 = "SELECT TIMEDIFF( DATE_FORMAT( CONVERT_TZ( NOW( ) , '-05:30', '+00:00' ) , '%H:%i:%s' ) , DATE_FORMAT( resume_time, '%H:%i:%s' ) ) AS difference FROM configuration";
    $time_difference_result2 = $con->query($time_difference_query2);
    $time_difference_row2 = mysqli_fetch_assoc($time_difference_result2);
    if (strpos($time_difference_row2['difference'], '-') !== false) {
        $emptyarray[]= array('time_status' => "1", 'resume' => $time_difference_row['resume_time']);
    } else {
        $emptyarray[]= array('time_status' => "2");
    }
}
echo json_encode($emptyarray);
