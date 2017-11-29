<?php

include_once 'config.php';

//$sales_person_id = filter_input(INPUT_POST, 'sales_person_id');

//$bill_id_query = "SELECT clear_date from payment_clear WHERE `sales_person_id`=$sales_person_id";
//$bill_no_result = $con->query($bill_id_query);
//
//$bill_no_row = mysqli_fetch_assoc($bill_no_result);
//
//$bill_no = $bill_no_row['clear_date'];


$status_sql = "SELECT CONCAT(works.name,\" commision\") AS particulars, amount,work_profits.insertion_date_time FROM work_profits,sales_persons,works WHERE sales_persons.id=work_profits.sales_person_id AND works.id=work_id AND work_profits.sales_person_id!=1 UNION ALL SELECT CONCAT(works.name,\":Advance:\",description) AS particulars, amount, works.insertion_date_time FROM work_advances,works WHERE works.id=work_advances.work_id UNION ALL SELECT CONCAT(works.name,\":Expense:\",description) AS particulars, amount, works.insertion_date_time FROM work_expenses,works WHERE works.id=work_expenses.work_id ORDER BY insertion_date_time DESC";
 
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
