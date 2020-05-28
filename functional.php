<?php
	header("Content-Type: text/html; charset=utf-8");
	require 'functional_sql.php';

	$func = $_POST['function_name'];
	//echo 'func = '.$func.'<br>';
	if(!strcmp("update_selfValuation", $func)){
		$result = update_selfValuation( $_POST['order_id'], $_POST['valuation_time']);
	}
	elseif(!strcmp("update_bookingValuation", $func)){
		$result = update_bookingValuation($_POST['order_id'], $_POST['moving_date'], $_POST['estimate_worktime'], $_POST['fee']);
	}
	elseif(!strcmp("add_vehicleDemand", $func)){
		$result = add_vehicleDemand($_POST['order_id'], $_POST['num'], $_POST['weight'], $_POST['type']);
	}
  elseif(!strcmp("add_vehicleAssignment", $func)){
		$result = add_vehicleAssignment($_POST['order_id'], $_POST['vehicle_assign']);
	}
	elseif(!strcmp("update_vehicleAssignment", $func)){
		$result = update_vehicleAssignment($_POST['order_id'], $_POST['vehicle_assign']);
	}
	elseif(!strcmp("update_todayOrder", $func)){
		$result = update_todayOrder($_POST['order_id'], $_POST['memo'], $_POST['fee']);
	}
	elseif(!strcmp("change_status", $func)){
		$result = change_status($_POST['table'], $_POST['order_id'], $_POST['status']);
	}
	elseif(!strcmp("check_status", $func)){
		$result = check_status($_POST['table'], $_POST['order_id'], $_POST['status']);
	}
	else{
		echo "function_name not found.";
		return;
		//$result = query("UPDATE `orders` SET memo = '2' WHERE order_id = 1;");
	}
  echo $result;

	return $result;
?>
