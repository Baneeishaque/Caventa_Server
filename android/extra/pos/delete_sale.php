<?php
include_once '../config.php';


$time_difference_query = "SELECT TIMEDIFF( DATE_FORMAT( CONVERT_TZ( NOW( ) , '-05:30', '+00:00' ) , '%H:%i:%s' ) , DATE_FORMAT( cut_time, '%H:%i:%s' ) ) AS difference,resume_time FROM configuration";
$time_difference_result = $con->query($time_difference_query);
$time_difference_row = mysqli_fetch_assoc($time_difference_result);

if (strpos($time_difference_row['difference'], '-') !== false) {
//    echo 'before';

//JSON string
 // $someJSON = '[{"name":"Jonathan Suh","gender":"male"},{"name":"William Philbin","gender":"male"},{"name":"Allison McKinnery","gender":"female"}]';

$json_data=$_POST['json_data'];

$result="0";
// Convert JSON string to Object
//$someObject = json_decode($someJSON);
$someObject = json_decode($json_data);
//echo $someObject[0]->name; // Access Object data





	foreach($someObject as $key => $value) {
		//echo $value->name . ", " . $value->gender . "<br>";
		// $sql="DELETE FROM `ticket` WHERE `id`=$value->id";
		$sql="UPDATE `vfmobo6d_lottery`.`ticket` SET `delete_status` = 1,`delete_time_stamp` = CONVERT_TZ(NOW(),'-05:30','+00:00'),`deleter` = 'POS' WHERE `id`=$value->id";
		// $sql="UPDATE `vfmobo6d_lottery`.`ticket` SET `delete_status` = 1,`delete_time_stamp` = NOW(),`deleter` = 'POS' WHERE `id`=$value->id";
		if(!$con->query($sql))
		{
			$result="1";
			break;
		}
	}

} else {
//    echo 'later';
	$result="2";
	}
echo $result;

 