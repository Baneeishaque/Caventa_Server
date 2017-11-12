<?php

include_once '../config.php';

$status_sql = "SELECT `status` FROM `configuration`";
$status_result = $con->query($status_sql);
$status_row = mysqli_fetch_assoc($status_result);

$emptyarray = array();

if ($status_row['status'] == 'OK') {

    $flavour = filter_input(INPUT_POST, 'flavour');

    if ($flavour == "master") {
        $sql = "SELECT `version_code`, `version_name` FROM `admin_configuration`";
    } else if ($flavour == "pos") {
        $sql = "SELECT `version_code`, `version_name` FROM `client_configuration`";
    }

    $result = $con->query($sql);
    
    while ($row = mysqli_fetch_assoc($result)) {
        $emptyarray[] = $row;
    }
    
} else {
    $emptyarray[] = array('version_code' => "0");
}

echo json_encode($emptyarray);


