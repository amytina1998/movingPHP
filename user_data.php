<?php
	header("Content-Type: text/html; charset=utf-8");
	require 'data_sql.php';

	$func = $_POST['function_name'];
	//echo 'func = '.$func.'<br>';
	if(preg_match("/\ball_user_data\b/",$func)){
		$result = all_user_data();
	}
	elseif(preg_match("/\buser_data\b/",$func)){
		$result = user_data($_POST['member_id']);
	}
	elseif (preg_match("/\border_detail\b/",$func)) {
		$result = order_detail($_POST['order_id']);
	}
	elseif (preg_match("/\border_member\b/",$func)) {
		$result = order_member($_POST['status']);
	}
	else{
		echo "function_name not found.";
		return;
	}

	for($i = 0; $i < $result->num_rows; $i++)
		$row_result[] = mysqli_fetch_assoc($result);

	$result_json = json_encode($row_result);
	echo $result_json;

	return $result_json;
?>
