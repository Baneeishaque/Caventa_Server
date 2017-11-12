<?php

include_once 'config.php';

$json_data = $_POST['json_data'];
$date = filter_input(INPUT_POST, 'date');

$result = "0";

$json_array = json_decode($json_data, TRUE);

$sql = "DELETE FROM `result` WHERE `date_time`='$date'";
//echo $sql;
if (!$con->query($sql)) {
    $result = "1";
} else {
    $sql = "INSERT INTO `result`(`scheme`, `date_time`, `serial`, `position`, `prize_money`) VALUES ('LSK','$date','" . $json_array[0]['LSK1'] . "',1,'" . $json_array[0]['LSKP1'] . "')";
//    echo $sql;
    if (!$con->query($sql)) {
        $result = "1";
    } else {
        $sql = "INSERT INTO `result`(`scheme`, `date_time`, `serial`, `position`, `prize_money`) VALUES ('BOX','$date','" . $json_array[0]['BOX1'] . "',1,'" . $json_array[0]['BOXP1'] . "')";
//        echo $sql;
        if (!$con->query($sql)) {
            $result = "1";
        } else {
            $sql = "INSERT INTO `result`(`scheme`, `date_time`, `serial`, `position`, `prize_money`) VALUES ('BOX','$date','" . $json_array[0]['BOX2'] . "',2,'" . $json_array[0]['BOXP2'] . "')";
//            echo $sql;
            if (!$con->query($sql)) {
                $result = "1";
            } else {
                $sql = "INSERT INTO `result`(`scheme`, `date_time`, `serial`, `position`, `prize_money`) VALUES ('BOX','$date','" . $json_array[0]['BOX3'] . "',3,'" . $json_array[0]['BOXP3'] . "')";
//                echo $sql;
                if (!$con->query($sql)) {
                    $result = "1";
                } else {
                    $sql = "INSERT INTO `result`(`scheme`, `date_time`, `serial`, `position`, `prize_money`) VALUES ('BOX','$date','" . $json_array[0]['BOX4'] . "',4,'" . $json_array[0]['BOXP4'] . "')";
//                    echo $sql;
                    if (!$con->query($sql)) {
                        $result = "1";
                    } else {
                        $sql = "INSERT INTO `result`(`scheme`, `date_time`, `serial`, `position`, `prize_money`) VALUES ('BOX','$date','" . $json_array[0]['BOX5'] . "',5,'" . $json_array[0]['BOXP5'] . "')";
//                        echo $sql;
                        if (!$con->query($sql)) {
                            $result = "1";
                        } else {
                            $sql = "INSERT INTO `result`(`scheme`, `date_time`, `serial`, `position`, `prize_money`) VALUES ('BOX','$date','" . $json_array[0]['BOX6'] . "',6,'" . $json_array[0]['BOXP6'] . "')";
//                            echo $sql;
                            if (!$con->query($sql)) {
                                $result = "1";
                            } else {
                                $sql = "INSERT INTO `result`(`scheme`, `date_time`, `serial`, `position`, `prize_money`) VALUES ('A','$date','" . $json_array[0]['A'] . "',1,'" . $json_array[0]['AP'] . "')";
//                                echo $sql;
                                if (!$con->query($sql)) {
                                    $result = "1";
                                } else {
                                    $sql = "INSERT INTO `result`(`scheme`, `date_time`, `serial`, `position`, `prize_money`) VALUES ('B','$date','" . $json_array[0]['B'] . "',1,'" . $json_array[0]['BP'] . "')";
//                                    echo $sql;
                                    if (!$con->query($sql)) {
                                        $result = "1";
                                    } else {
                                        $sql = "INSERT INTO `result`(`scheme`, `date_time`, `serial`, `position`, `prize_money`) VALUES ('C','$date','" . $json_array[0]['C'] . "',1,'" . $json_array[0]['CP'] . "')";
//                                        echo $sql;
                                        if (!$con->query($sql)) {
                                            $result = "1";
                                        } else {
                                            $sql = "INSERT INTO `result`(`scheme`, `date_time`, `serial`, `position`, `prize_money`) VALUES ('LSK','$date','" . $json_array[0]['LSK2'] . "',2,'" . $json_array[0]['LSKP2'] . "')";
//                                            echo $sql;
                                            if (!$con->query($sql)) {
                                                $result = "1";
                                            } else {
                                                $sql = "INSERT INTO `result`(`scheme`, `date_time`, `serial`, `position`, `prize_money`) VALUES ('LSK','$date','" . $json_array[0]['LSK3'] . "',3,'" . $json_array[0]['LSKP3'] . "')";
//                                                echo $sql;
                                                if (!$con->query($sql)) {
                                                    $result = "1";
                                                } else {
                                                    $sql = "INSERT INTO `result`(`scheme`, `date_time`, `serial`, `position`, `prize_money`) VALUES ('LSK','$date','" . $json_array[0]['LSK4'] . "',4,'" . $json_array[0]['LSKP4'] . "')";
//                                                    echo $sql;
                                                    if (!$con->query($sql)) {
                                                        $result = "1";
                                                    } else {
                                                        $sql = "INSERT INTO `result`(`scheme`, `date_time`, `serial`, `position`, `prize_money`) VALUES ('LSK','$date','" . $json_array[0]['LSK5'] . "',5,'" . $json_array[0]['LSKP5'] . "')";
//                                                        echo $sql;
                                                        if (!$con->query($sql)) {
                                                            $result = "1";
                                                        } else {
                                                            $sql = "INSERT INTO `result`(`scheme`, `date_time`, `serial`, `position`, `prize_money`) VALUES ('AB','$date','" . $json_array[0]['AB'] . "',1,'" . $json_array[0]['ABP'] . "')";
//                                                            echo $sql;
                                                            if (!$con->query($sql)) {
                                                                $result = "1";
                                                            } else {
                                                                $sql = "INSERT INTO `result`(`scheme`, `date_time`, `serial`, `position`, `prize_money`) VALUES ('BC','$date','" . $json_array[0]['BC'] . "',1,'" . $json_array[0]['BCP'] . "')";
//                                                                echo $sql;
                                                                if (!$con->query($sql)) {
                                                                    $result = "1";
                                                                } else {
                                                                    $sql = "INSERT INTO `result`(`scheme`, `date_time`, `serial`, `position`, `prize_money`) VALUES ('AC','$date','" . $json_array[0]['AC'] . "',1,'" . $json_array[0]['ACP'] . "')";
//                                                                    echo $sql;
                                                                    if (!$con->query($sql)) {
                                                                        $result = "1";
                                                                    } else {
                                                                        for ($i = 1; $i < sizeof($json_array); $i++) {
                                                                            $sql = "INSERT INTO `result`(`scheme`, `date_time`, `serial`, `position`, `prize_money`) VALUES ('LSK','$date','" . $json_array[$i]['serial'] . "','" . $json_array[$i]['position'] . "','" . $json_array[$i]['price'] . "')";
//                                                                            echo $sql;
                                                                            if (!$con->query($sql)) {
                                                                                $result = "1";
                                                                                break;
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
$arr = array('result' => $result, 'error' => mysqli_error($con));

echo json_encode($arr);

