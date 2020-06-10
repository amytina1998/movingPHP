<?php

function update_new($order_id, $new){
	$sql_query = "UPDATE `orders` ";
	$sql_query .= "SET new = ".$new." ";
	$sql_query .= "WHERE order_id = ".$order_id.";";
	$result = query($sql_query);
	if(!strcmp($result, "1")) return "success";
	else return $result;
}

function update_selfValuation($order_id, $valuation_time){
	$sql_query = "UPDATE `valuation` SET ";
	$sql_query .= "valuation_time = '".$valuation_time."' ";
	$sql_query .= "WHERE order_id = ".$order_id.";";
	$result = query($sql_query);
	if(!strcmp($result, "1"))
		return change_status("valuation", $order_id, "booking");
	else return $result;
}

function update_bookingValuation($order_id, $moving_date, $estimate_worktime, $fee, $num, $weight, $type){
	$sql_query = "UPDATE `orders` SET ";
	$sql_query .= "moving_date = '".$moving_date."', ";
	$sql_query .= "estimate_worktime = '".$estimate_worktime."', ";
	$sql_query .= "fee = ".$fee." ";
	$sql_query .= "WHERE order_id = ".$order_id.";";
	$result = query($sql_query);
	$result2 = add_vehicleDemand($order_id, $num, $weight, $type);
	if(!strcmp($result, "1")){
		if(!strcmp($result2, "success"))
			return change_status("valuation", $order_id, "match");
		else return "vehicle_assignment: ".$result2;
	}
	else return "bookingValuation: ".$result;
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
	if(!strcmp($result, "1"))
		return change_status("orders", $order_id, "done");
	else return $result;
}

function modify_vehicleAssignment($order_id, $vehicle_assign){
	$ja = json_decode($vehicle_assign, true);
	$result_d = delete_vehicleAssignment($order_id, $vehicle_assign); //先刪掉沒被分派到的車子
	foreach ($ja as $count => $vehicle_id) {
		$result = add_vehicleAssignment($order_id, $vehicle_id);
		if(!strcmp($result, "success") || preg_match("/PRIMARY/", $result))
			$check[$vehicle_id]="success";
		else
			$check[$vehicle_id]=$result;
	}
	if(count(array_unique($check))===1 && end($check)==="success"){
			if(!strcmp($result_d, "success"))
				return "success";
			else return "delete error: ".$result_d;
	}
	else{
		if(!strcmp($result_d, "success"))
			return $check;
	 	else return "delete error: ".$result_d;
	}
}

function delete_vehicleAssignment($order_id, $vehicle_assign){
	$ja = json_decode($vehicle_assign, true);
	$sql_query = "DELETE FROM `vehicle_assignment` ";
	$sql_query .= "WHERE order_id = ".$order_id." ";
	foreach ($ja as $key => $vehicle_id)
		$sql_query .= "AND vehicle_id <> ".$vehicle_id." "; //不等於
	$sql_query .= ";";
	$result = query($sql_query);
	if(!strcmp($result, "1")) return "success";
	else return $result;
}

function add_vehicleAssignment($order_id, $vehicle_id){;
	$sql_query = "INSERT INTO `vehicle_assignment` VALUES ";
	$sql_query .= "(".$order_id.", ".$vehicle_id.");";
	$result = query($sql_query);
	if(!strcmp($result, "1")) return "success";
	else return $result;
}

function change_status($table, $order_id, $status){
	$sql_query = "UPDATE `".$table."` ";
	$sql_query .="SET status = '".$status."' ";
	$sql_query .="WHERE order_id = '".$order_id."';";
	$result = query($sql_query);
	if(!strcmp($result, "1")) {
		$result2 = update_new($order_id, 'TRUE');
		if(!strcmp($result2, "success")) return "success";
		else return $result;
	}
	else return $result;
}

function check_status($table, $order_id, $status){
  $sql_query = "SELECT status FROM `".$table."` ";
  $sql_query .= "WHERE order_id = ".$order_id.";";
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
