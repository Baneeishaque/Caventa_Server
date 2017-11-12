<?php

include_once 'config.php';

$work_id = filter_input(INPUT_POST, 'sales_person_id');

$status_sql = "SELECT name,amount FROM works,work_profits WHERE work_profits.sales_person_id=$work_id AND works.id=work_profits.work_id";
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
