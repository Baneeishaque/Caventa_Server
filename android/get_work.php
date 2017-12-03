<?php

include_once 'config.php';

$work_id = filter_input(INPUT_POST, 'work_id');

$status_sql = "SELECT `description` AS `advance_description`, `amount` FROM `work_advances` WHERE `work_id`=$work_id";
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

$status_sql = "SELECT `description` AS `expense_description`, `amount` FROM `work_expenses` WHERE `work_id`=$work_id";
$status_result = $con->query($status_sql);

if (mysqli_num_rows($status_result) != 0) {

    array_push($emptyarray, array("status" => "0"));

    while ($status_row = mysqli_fetch_assoc($status_result)) {
        $emptyarray[] = $status_row;
    }
} else {
    array_push($emptyarray, array("status" => "1"));
}

echo json_encode($emptyarray);
