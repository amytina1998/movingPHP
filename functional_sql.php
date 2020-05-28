<?php

function update_selfValuation($order_id, $valuation_time){
	$sql_query = "UPDATE `valuation` SET ";
	$sql_query .= "valuation_time = '".$valuation_time."' ";
	$sql_query .= "WHERE order_id = ".$order_id.";";
	$result = query($sql_query);
	if(!strcmp($result, "1"))
		return change_status("valuation", $order_id, "booking");
	else return $result;
}

function update_bookingValuation($order_id, $moving_date, $estimate_worktime, $fee){
	$sql_query = "UPDATE `orders` SET ";
	$sql_query .= "moving_date = '".$moving_date."', ";
	$sql_query .= "estimate_worktime = '".$estimate_worktime."', ";
	$sql_query .= "fee = ".$fee." ";
	$sql_query .= "WHERE order_id = ".$order_id.";";
	$result = query($sql_query);
	if(!strcmp($result, "1"))
		return change_status("valuation", $order_id, "match");
	else return $result;
}

function add_vehicleDemand($order_id, $num, $weight, $type){
	$sql_query = "INSERT INTO `vehicle_demand` VALUES ";
	$sql_query .="(".$order_id.", ".$num.", '".$weight."', '".$type."');";
	$result = query($sql_query);
	if(!strcmp($result, "1")) return "success";
	else return $result;
}

function update_todayOrder($order_id, $memo, $fee){
	$sql_query = "UPDATE `orders` SET ";
	$sql_query .= "memo = '".$memo."', ";
	$sql_query .= "fee = ".$fee." ";
	$sql_query .= "WHERE order_id = ".$order_id.";";
	$result = query($sql_query);
	if(!strcmp($result, "1")) return "success";
	else return $result;
}

function update_vehicleAssignment($order_id, $vehicle_assign){
	$ja = json_decode($vehicle_assign, true);
	$sql_query = "UPDATE `vehicle_assignment` SET ";
	$sql_query .= "(".$order_id.", ".$ve.")"
}

function add_vehicleAssignment($order_id, $vehicle_assign){
	$ja = json_decode($vehicle_assign, true);
	foreach ($ja as $count => $json) { //取多筆資料
		$sql_query = "INSERT INTO `vehicle_assignment` VALUES ";
		$sql_query .= "(".$order_id.", ";
			foreach ($json as $key => $value) { //取單筆資料裡的值
				$sql_query .= $value;
				if(!strcmp($key,"vehicle_id")) $sql_query .= ", ";
			}
		$sql_query .= ");";

		$result = query($sql_query);
		if(!strcmp($result, "1")){
			echo "success";
			$check[$key]="success";
		}
		elseif(preg_match("/PRIMARY/", $result))
			update_vehicleAssignment($order_id, $ja[$count]);
		else{
			echo $result;
			$check[$key]=$result;
		}
	}
}

function change_status($table, $order_id, $status){
	$sql_query = "UPDATE `".$table."` ";
	$sql_query .="SET status = '".$status."' ";
	$sql_query .="WHERE order_id = '".$order_id."';";
	$result = query($sql_query);
	if(!strcmp($result, "1")) return "success";
	else return $result;
}

function check_status($table, $order_id, $status){
  $sql_query = "SELECT status FROM `".$table."` ";
  $sql_query .= "WHERE order_id = '".$order_id."';";
  $result = query($sql_query);
  $row_result = mysqli_fetch_assoc($result);
  if(!strcmp($row_result['status'], $status)) return "success";
  else return "failed";
}

function query($sql_query){
  require './connDB.php';
	$result = mysqli_query($db_link, $sql_query);
	if(!$result) $result = "Error: ".mysqli_error($db_link);
  mysqli_close($db_link);
  return $result;
}
?>
