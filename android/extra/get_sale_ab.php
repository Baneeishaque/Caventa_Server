<?php

include_once 'config.php';

$date = filter_input(INPUT_POST, 'date');

$emptyarray = array();

$sql_sum = "SELECT SUM(amount) AS Amount FROM ticket WHERE `insertion_date`='$date'";
//echo $sql_sum;
$result_sum = $con->query($sql_sum);
$row_sum = mysqli_fetch_assoc($result_sum);
array_push($emptyarray, array("sum" => $row_sum['Amount']));

$sql = "SELECT DISTINCT `agent`,`name`,`scheme` FROM `ticket`,`agents` WHERE `agent`=`username` AND `insertion_date`='$date' AND (`scheme`='AB' OR `scheme`='BC' OR `scheme`='AC') ";
//echo $sql;
$result = $con->query($sql);
while ($row = mysqli_fetch_assoc($result)) {
    $sql2 = "SELECT DISTINCT `serial` FROM `ticket` WHERE `agent`='" . $row['agent'] . "' AND `insertion_date`='$date' AND (`scheme`='AB' OR `scheme`='BC' OR `scheme`='AC') ";
//    echo $sql2;
    $result2 = $con->query($sql2);
    while ($row2 = mysqli_fetch_assoc($result2)) {
        $sql3 = "SELECT SUM(`count`) AS `count` FROM `ticket` WHERE `agent`='" . $row['agent'] . "' AND `serial`='" . $row2['serial'] . "' AND `insertion_date`='$date' AND (`scheme`='AB' OR `scheme`='BC' OR `scheme`='AC') ";
//        echo $sql3;
        $result3 = $con->query($sql3);
        while ($row3 = mysqli_fetch_assoc($result3)) {
            array_push($emptyarray, array("serial" => $row2['serial'], "count" => $row3['count'], "agent" => $row['agent'], "name" => $row['name'], "scheme" => $row['scheme']));
        }
    }
}

echo json_encode($emptyarray);
