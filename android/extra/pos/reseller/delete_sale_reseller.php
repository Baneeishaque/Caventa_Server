<?php
include_once '../../config.php';

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
		
		$sql="UPDATE `vfmobo6d_lottery`.`ticket` SET `delete_status` = 1,`delete_time_stamp` = CONVERT_TZ(NOW(),'-05:30','+00:00'),`deleter` = 'Reseller' WHERE `id`=$value->id";
		// $sql="UPDATE `vfmobo6d_lottery`.`ticket` SET `delete_status` = 1,`delete_time_stamp` = NOW(),`deleter` = 'Reseller' WHERE `id`=$value->id";
		
		if(!$con->query($sql))
		{
			$result="1";
			break;
		}
	}


echo $result;

 