<?php

include_once 'config.php';

$sales_person_id = filter_input(INPUT_POST, 'sales_person_id');


//$bill_id_query = "SELECT clear_date from payment_clear WHERE `sales_person_id`=$sales_person_id";
//$bill_no_result = $con->query($bill_id_query);
//
//$bill_no_row = mysqli_fetch_assoc($bill_no_result);
//
//$bill_no = $bill_no_row['clear_date'];


$status_sql = "SELECT clear_date,clear_time,name,amount FROM works,work_profits,payment_clear WHERE work_profits.sales_person_id=$sales_person_id AND works.id=work_profits.work_id AND payment_clear.sales_person_id=$sales_person_id AND work_profits.insertion_date_time >= clear_date";
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
