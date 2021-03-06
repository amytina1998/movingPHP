<?php
	header("Content-Type: text/html; charset=utf-8");
	require 'functional_sql.php';

	$func = $_POST['function_name'];
	//echo 'func = '.$func.'<br>';
	if(!strcmp("update_new", $func)){
		$result = update_new($_POST['order_id'], $_POST['new']);
	}
	elseif(!strcmp("update_selfValuation", $func)){
		$result = update_selfValuation( $_POST['order_id'], $_POST['valuation_time']);
	}
	elseif(!strcmp("update_bookingValuation", $func)){
		$result = update_bookingValuation(
			$_POST['order_id'],
			$_POST['moving_date'], $_POST['estimate_worktime'], $_POST['fee'],
			$_POST['num'], $_POST['weight'], $_POST['type']);
	}
	elseif(!strcmp("add_vehicleDemand", $func)){
		$result = add_vehicleDemand($_POST['order_id'], $_POST['num'], $_POST['weight'], $_POST['type']);
	}
  elseif(!strcmp("add_vehicleAssignment", $func)){
		$result = add_vehicleAssignment($_POST['order_id'], $_POST['vehicle_assign']);
	}
	elseif(!strcmp("update_todayOrder", $func)){
		$result = update_todayOrder($_POST['order_id'], $_POST['memo'], $_POST['fee']);
	}
	elseif(!strcmp("modify_vehicleAssignment", $func)){
		$result = modify_vehicleAssignment($_POST['order_id'], $_POST['vehicle_assign']);
	}
	elseif(!strcmp("delete_vehicleAssignment", $func)){
		$result = delete_vehicleAssignment($_POST['order_id'], $_POST['vehicle_assign']);
	}
	elseif(!strcmp("add_vehicleAssignment", $func)){
		$result = add_vehicleAssignment($_POST['order_id'], $_POST['vehicle_id']);
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
	}

  //echo $result;
	print_r($result);

	return $result;
?>
