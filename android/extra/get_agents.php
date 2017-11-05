<?php

include_once 'config.php';
$get_agents_sql = "SELECT `username`, `password`, `role`, `userid`, `A`, `AB`, `ABC`, `phone`, `name`, `shop`, `address`, `place`, `agent_money_ab`, `agent_money_a`, `agent_money_lsk1`, `agent_money_lsk2`, `agent_money_lsk3`, `agent_money_lsk4`, `agent_money_lsk5`, `agent_money_lsk6`, `agent_money_box1`, `agent_money_box2` FROM `agents`";

$result = $con->query($get_agents_sql);
$emptyarray = array();
if (mysqli_num_rows($result) != 0) {

    array_push($emptyarray, array("status" => "0"));
    while ($row = mysqli_fetch_assoc($result)) {
        $emptyarray[] = $row;
    }
} else {
    array_push($emptyarray, array("status" => "1"));
}

echo json_encode($emptyarray);
