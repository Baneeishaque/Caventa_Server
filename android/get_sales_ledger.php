<?php

include_once 'config.php';

$sales_person_id = filter_input(INPUT_POST, 'sales_person_id');

if ($sales_person_id == 1) {
    $status_sql = "SELECT @a := @a +1 serial_number,CONCAT( works.name,  \":~Advance:\", description ) AS particulars, amount, works.insertion_date_time FROM work_advances,works,(SELECT @a :=0) AS a WHERE works.id = work_advances.work_id AND works.sales_person_id =1 "
            . "UNION ALL "
            . "SELECT @a := @a +1 serial_number,CONCAT( works.name,  \":~Expense:\", description ) AS particulars, amount, works.insertion_date_time FROM work_expenses,works WHERE works.id = work_expenses.work_id AND works.sales_person_id =1 "
//            . "UNION ALL "
//            . "SELECT CONCAT( works.name,  \" ~Commission\" ) AS particulars, amount, work_profits.insertion_date_time FROM work_profits, sales_persons, works WHERE sales_persons.id = work_profits.sales_person_id AND works.id = work_id AND works.sales_person_id =1 "
            . "ORDER BY insertion_date_time,serial_number";
} else {
    $status_sql = "SELECT @a := @a +1 serial_number,CONCAT( works.name,  \":~Advance:\", description ) AS particulars, amount, works.insertion_date_time FROM work_advances,works,(SELECT @a :=0) AS a WHERE works.id = work_advances.work_id AND works.sales_person_id =$sales_person_id "
            . "UNION ALL "
            . "SELECT @a := @a +1 serial_number,CONCAT( works.name,  \":~Expense:\", description ) AS particulars, amount, works.insertion_date_time FROM work_expenses,works WHERE works.id = work_expenses.work_id AND works.sales_person_id =$sales_person_id "
            . "UNION ALL "
            . "SELECT @a := @a +1 serial_number,CONCAT( works.name,  \" ~Commission\" ) AS particulars, amount, work_profits.insertion_date_time FROM work_profits, sales_persons,works WHERE sales_persons.id = work_profits.sales_person_id AND works.id = work_id AND works.sales_person_id =$sales_person_id AND work_profits.sales_person_id!=1 "
            . "ORDER BY insertion_date_time,serial_number";
}

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
