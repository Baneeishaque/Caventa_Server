<?php

include_once 'config.php';

$sales_person_id = filter_input(INPUT_POST, 'sales_person_id');

$status_sql = "SELECT `id`, `name`, `address`, `work_date`, `status`, `sales_person_id` FROM `works` WHERE `sales_person_id`=$sales_person_id";
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


