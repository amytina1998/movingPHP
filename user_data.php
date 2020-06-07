<?php
	header("Content-Type: text/html; charset=utf-8");
	require 'data_sql.php';

	$func = $_POST['function_name'];
	//echo 'func = '.$func.'<br>';
	if(preg_match("/\ball_user_data\b/",$func)){
		$result[] = all_user_data();
	}
	elseif(!strcmp("user_data", $func)){
		$result[] = user_data($_POST['member_id']);
	}
	elseif (!strcmp("order_member",$func)) {
		$result[] = order_member($_POST['startDate'], $_POST['endDate'], $_POST['status'], 'TRUE');
		$result[] = order_member($_POST['startDate'], $_POST['endDate'], $_POST['status'], 'FALSE');
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
		$result[] = valuation_member($_POST['status']);
	}
	elseif (!strcmp("valuation_detail",$func)) {
		$result[] = valuation_detail($_POST['order_id']);
	}
	elseif (!strcmp("staff_detail",$func)) {
		$result[] = staff_detail($_POST['order_id']);
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
