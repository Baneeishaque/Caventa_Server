<?php

include_once 'config.php';

$work_id = filter_input(INPUT_POST, 'work_id');

$get_profit_sql = "SELECT get_work_profit($work_id) AS `profit`,`works`.`sales_person_id` FROM `works` WHERE `works`.`id`=$work_id";

$get_profit_result = $con->query($get_profit_sql);

$get_profit_row = mysqli_fetch_assoc($get_profit_result);

//echo 'Total Profit : ' . $get_profit_row['profit'];
//
//echo 'Total Sales Person Profit : ' . ($get_profit_row['profit'] * 0.6);
//echo 'Total Caventa Profit : ' . ($get_profit_row['profit'] * 0.4);

$status_update_sql = "UPDATE `works` SET `status`=1 WHERE `id`=$work_id";

if (!$con->query($status_update_sql)) {
    $arr = array('status' => "1", 'error' => $con->error);
} else {

    if ($get_profit_row['sales_person_id'] == 1) {

        $insert_profit_query_caventa = "INSERT INTO `work_profits`(`work_id`, `amount`, `sales_person_id`) VALUES ($work_id," . $get_profit_row['profit'] . ",1)";

        if (!$con->query($insert_profit_query_caventa)) {
            $arr = array('status' => "1", 'error' => $con->error);
        } else {

            $arr = array('status' => "0");
        }
    } else {

        $insert_profit_query_sales_person = "INSERT INTO `work_profits`(`work_id`, `amount`, `sales_person_id`) VALUES ($work_id," . ($get_profit_row['profit'] * 0.6) . "," . $get_profit_row['sales_person_id'] . ")";
        $insert_profit_query_caventa = "INSERT INTO `work_profits`(`work_id`, `amount`, `sales_person_id`) VALUES ($work_id," . ($get_profit_row['profit'] * 0.4) . ",1)";

        if (!$con->query($insert_profit_query_sales_person)) {
            $arr = array('status' => "1", 'error' => $con->error);
        } else {

            if (!$con->query($insert_profit_query_caventa)) {
                $arr = array('status' => "1", 'error' => $con->error);
            } else {

                $arr = array('status' => "0");
            }
        }
    }
}
echo json_encode($arr);
