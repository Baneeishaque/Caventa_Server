<?php

include_once 'config.php';

$name = filter_input(INPUT_POST, 'name');
$shop = filter_input(INPUT_POST, 'shop');
$address = filter_input(INPUT_POST, 'address');
$place = filter_input(INPUT_POST, 'place');
$contact = filter_input(INPUT_POST, 'contact');
$username = filter_input(INPUT_POST, 'username');
$password = filter_input(INPUT_POST, 'password');
$a = filter_input(INPUT_POST, 'a');
$ab = filter_input(INPUT_POST, 'ab');
$abc = filter_input(INPUT_POST, 'abc');

$agent_money_lsk1 = filter_input(INPUT_POST, 'agent_money_lsk1');
$agent_money_lsk2 = filter_input(INPUT_POST, 'agent_money_lsk2');
$agent_money_lsk3 = filter_input(INPUT_POST, 'agent_money_lsk3');
$agent_money_lsk4 = filter_input(INPUT_POST, 'agent_money_lsk4');
$agent_money_lsk5 = filter_input(INPUT_POST, 'agent_money_lsk5');
$agent_money_lsk6 = filter_input(INPUT_POST, 'agent_money_lsk6');

$agent_money_box1 = filter_input(INPUT_POST, 'agent_money_box1');
$agent_money_box2 = filter_input(INPUT_POST, 'agent_money_box2');

$agent_money_ab = filter_input(INPUT_POST, 'agent_money_ab');
$agent_money_a = filter_input(INPUT_POST, 'agent_money_a');


$sql = "INSERT INTO `agents`(`username`, `password`, `role`, `A`, `AB`, `ABC`, `phone`, `name`, `shop`, `address`, `place`,`agent_money_lsk1`,`agent_money_lsk2`,`agent_money_lsk3`,`agent_money_lsk4`,`agent_money_lsk5`,`agent_money_lsk6`,`agent_money_box1`,`agent_money_box2`,`agent_money_ab`,`agent_money_a`) VALUES ('$username','$password','Main',$a,$ab,$abc,'$contact','$name','$shop','$address','$place',$agent_money_lsk1,$agent_money_lsk2,$agent_money_lsk3,$agent_money_lsk4,$agent_money_lsk5,$agent_money_lsk6,$agent_money_box1,$agent_money_box2,$agent_money_ab,$agent_money_a)";

if (!$con->query($sql)) {
    $arr = array('status' => "1", 'error' => $con->error);
} else {
    $sql = "INSERT INTO `payment_clear`(`agent`) VALUES ('$username')";
    if (!$con->query($sql)) {
        $arr = array('status' => "1", 'error' => $con->error);
    } else {
        $arr = array('status' => "0");
    }
}
echo json_encode($arr);
