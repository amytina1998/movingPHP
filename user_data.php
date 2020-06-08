<?php
	header("Content-Type: text/html; charset=utf-8");
	require 'data_sql.php';

	$func = $_POST['function_name'];
	//echo 'func = '.$func.'<br>';
	if (!strcmp("order_member",$func)) {
		if(isset($_POST['startDate'])){
			$result[] = order_member($_POST['startDate'], $_POST['endDate'], $_POST['status'], 'TRUE');
			$result[] = order_member($_POST['startDate'], $_POST['endDate'], $_POST['status'], 'FALSE');
		}
		else{
			$result[] = order_member('2020-01-01', '2020-12-31', $_POST['status'], 'TRUE');
			$result[] = order_member('2020-01-01', '2020-12-31', $_POST['status'], 'FALSE');
		}
	}
	elseif (!strcmp("order_member_today",$func)) {
		$result[] = order_member_today();
	}
	elseif (!strcmp("order_detail",$func)) {
		$result[] = order_detail($_POST['order_id']);
		$result[] = vehicle_detail($_POST['order_id']);
		$result[] = staff_detail($_POST['order_id']);
	}
	elseif (!strcmp("valuation_member",$func)) {
		if(isset($_POST['startDate'])){
			$result[] = valuation_member($_POST['startDate'], $_POST['endDate'], $_POST['status'], 'TRUE');
			$result[] = valuation_member($_POST['startDate'], $_POST['endDate'], $_POST['status'], 'FALSE');
		}
		else{
			$result[] = valuation_member('2020-01-01', '2020-12-31', $_POST['status'], 'TRUE');
			$result[] = valuation_member('2020-01-01', '2020-12-31', $_POST['status'], 'FALSE');
		}
	}
	elseif (!strcmp("valuation_detail",$func)) {
		$result[] = valuation_detail($_POST['order_id']);
	}
	elseif (!strcmp("staff_detail",$func)) {
		$result[] = staff_detail($_POST['order_id']);
	}
	elseif(!strcmp("staff-vehicle_data", $func)){
		$result[] = all_staff_data();
		$result[] = all_vehicle_data();
	}
	elseif(!strcmp("all_staff_data", $func)){
		$result[] = all_staff_data();
	}
	elseif(!strcmp("all_vehicle_data", $func)){
		$result[] = all_vehicle_data();
	}
	elseif(!strcmp("all_user_data", $func)){
		$result[] = all_user_data();
	}
	elseif(!strcmp("user_data", $func)){
		$result[] = user_data($_POST['member_id']);
	}
	else{
		echo "function_name not found.";
		return;
	}

	for($i = 0; $i < count($result); $i++)
			for($ii = 0; $ii < $result[$i]->num_rows; $ii++)
				$row_result[] = mysqli_fetch_assoc($result[$i]);

	$result_json = json_encode($row_result);
	echo $result_json;

	return $result_json;
?>
