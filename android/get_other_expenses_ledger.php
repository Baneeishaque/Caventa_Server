<?php

include_once 'config.php';

$status_sql = "SELECT `insertion_date_time`, `description`, `amount` FROM `other_expenses`";
//echo $status_sql;

$status_result = $con->query($status_sql);

$emptyarray = array();

if (mysqli_num_rows($status_result) != 0) {

    array_push($emptyarray, array("status" => "0"));

    while ($status_row = mysqli_fetch_assoc($status_result)) {
        $emptyarray[] = $status_row;
    }
} else {
    array_push($emptyarray, array("status" => "1"));
}
echo json_encode($emptyarray);
