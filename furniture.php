<?php
	header("Content-Type: text/html; charset=utf-8");
	require 'furniture_sql.php';

	$func = $_POST['function_name'];
	//echo 'func = '.$func.'<br>';
	if (!strcmp("furniture_detail",$func)) {
		$result = furniture_detail($_POST['order_id']);
	}
	elseif (!strcmp("furniture_each_detail",$func)) {
		$result = furniture_each_detail($_POST['order_id']);
	}
	elseif (!strcmp("furniture_room_detail",$func)) {
		$result = furniture_room_detail($_POST['order_id']);
	}
	elseif(!strcmp("modify_furniture", $func)){
		$result = modify_furniture($_POST['order_id'], $_POST['furniture_data']);
	}
	elseif(!strcmp("add_furniture", $func)){
		$result = add_furniture($_POST['order_id'], $_POST['name'], $_POST['num']);
	}
	elseif(!strcmp("update_furniture", $func)){
		$result = update_furniture($_POST['furniture_id'], $_POST['name'], $_POST['num']);
	}
	elseif(!strcmp("delete_furniture", $func)){
		$result = delete_furniture($_POST['furniture_id']);
	}
	else{
		echo "function_name not found.";
		return;
	}

	if(!strcmp(gettype($result), "string")){
		echo $result;
		return $result;
	}

	for($i = 0; $i < $result->num_rows; $i++)
		$row_result[] = mysqli_fetch_assoc($result);

	$result_json = json_encode($row_result);
	echo $result_json;

	return $result_json;
?>
