<?php

include_once 'config.php';

$work_name = filter_input(INPUT_POST, 'work_name');
$work_address = filter_input(INPUT_POST, 'work_address');
$work_date = filter_input(INPUT_POST, 'work_date');
$sales_person_id = filter_input(INPUT_POST, 'sales_person_id');

$advances_json = filter_input(INPUT_POST, 'advances_json');
$expenses_json = filter_input(INPUT_POST, 'expenses_json');

$sql = "INSERT INTO `works`(`name`, `address`, `work_date`,`insertion_date_time`, `sales_person_id`) VALUES ('$work_name','$work_address','$work_date',CONVERT_TZ(NOW(),'-05:30','+00:00'),$sales_person_id)";

//$bill_id_query = "SELECT MAX(id) AS id from works";
//$bill_no_result = $con->query($bill_id_query);
//
//$bill_no_row = mysqli_fetch_assoc($bill_no_result);
//if ($bill_no_row['id'] == '') {
//    $bill_no = 1;
//} else {
//    $bill_no = $bill_no_row['id'] + 1;
//}

if (!$con->query($sql)) {
    $arr = array('status' => "1", 'error' => $con->error);
} else {
    $work_id = $con->insert_id;
    
    $advances_json_objects = json_decode($advances_json);

    foreach ($advances_json_objects as $key => $value) {

        $sql = "INSERT INTO `work_advances`(`description`, `amount`, `work_id`, `insertion_date_time`) VALUES ('$value->description',$value->amount,$work_id,CONVERT_TZ(NOW(),'-05:30','+00:00'))";

        if (!$con->query($sql)) {
            $arr = array('status' => "1", 'error' => $con->error);
            break;
        }
    }

    $expenses_json_objects = json_decode($expenses_json);

    foreach ($expenses_json_objects as $key => $value) {

        $sql = "INSERT INTO `work_expenses`(`description`, `amount`, `work_id`, `insertion_date_time`) VALUES ('$value->description',$value->amount,$work_id,CONVERT_TZ(NOW(),'-05:30','+00:00'))";

        if (!$con->query($sql)) {
            $arr = array('status' => "1", 'error' => $con->error);
            break;
        }
    }

    $arr = array('status' => "0");
}
echo json_encode($arr);
