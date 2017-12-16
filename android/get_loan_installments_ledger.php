<?php

include_once 'config.php';

$loan_id = filter_input(INPUT_POST, 'loan_id');

$status_sql = "SELECT `id`,`insertion_date_time`, `receipt_number`, `payed_amount`, `principle`, `intrest`, `remarks` FROM `loan_installments` WHERE `loan_id` = $loan_id";

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
