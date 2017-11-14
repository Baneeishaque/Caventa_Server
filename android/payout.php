<?php

include_once 'config.php';

$sales_person_id = filter_input(INPUT_POST, 'sales_person_id');

$payment_date_update_sql = "UPDATE `payment_clear` SET `clear_date`=CONVERT_TZ(NOW(),'-05:30','+00:00'),`clear_time`=CONVERT_TZ(NOW(),'-05:30','+00:00') WHERE `sales_person_id`=$sales_person_id";

if (!$con->query($payment_date_update_sql)) {
    $arr = array('status' => "1", 'error' => $con->error);
} else {
    $arr = array('status' => "0");
}
echo json_encode($arr);
