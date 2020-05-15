<?php
	header("Content-Type: text/html; charset=utf-8");
	require 'data_sql.php';

	session_start();

	$func = $_POST['function_name'];
	echo 'func = '.$func.'<br>';
	if(preg_match("/\ball_user_data\b/",$func)){
		$result = all_user_data();
	}
	else if(preg_match("/\buser_data\b/",$func)){
		$_SESSION['member_id'] = $_POST['member_id'];
		$result = user_data();
	}
	else{
		echo "function_name not found.";
		return;
	}
	session_unset();

	for($i = 0; $i < $result->num_rows; $i++)
		$row_result[] = mysqli_fetch_assoc($result);

	$result_json = json_encode($row_result);
	echo $result_json;

	return $result_json;
?>
