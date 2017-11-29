<?php

include_once 'config.php';
$loan_id= filter_input(INPUT_POST, 'loan_id');
$receipt_number = filter_input(INPUT_POST, 'receipt_number');
$payed_amount = filter_input(INPUT_POST, 'payed_amount');
$principle = filter_input(INPUT_POST, 'principle');
$intrest = filter_input(INPUT_POST, 'intrest');
$remarks = filter_input(INPUT_POST, 'remarks');
// $sql = "INSERT INTO `works`(`name`, `address`, `work_date`,`insertion_date_time`, `sales_person_id`) VALUES ('$work_name','$work_address','$work_date',CONVERT_TZ(NOW(),'-05:30','+00:00'),$sales_person_id)";
//$sql="INSERT INTO `investments`( `insertion_date_time`, `description`, `amount`) VALUES (CONVERT_TZ(NOW(),'-05:30','+00:00'),'$description',$amount)";
$sql="INSERT INTO `loan_installments`(`loan_id`, `insertion_date_time`, `receipt_number`, `payed_amount`, `principle`, `intrest`, `remarks`) VALUES ($loan_id,CONVERT_TZ(NOW(),'-05:30','+00:00'),$receipt_number,$payed_amount,$principle,$intrest,$remarks)";
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
    
    $arr = array('status' => "0");
}
echo json_encode($arr);
