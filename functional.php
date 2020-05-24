<?php
	header("Content-Type: text/html; charset=utf-8");
	require 'functional_sql.php';

	$func = $_POST['function_name'];
	//echo 'func = '.$func.'<br>';
  if(!strcmp("change_status", $func)){
		$result = change_status($_POST['table'], $_POST['order_id'], $_POST['status']);
	}
	elseif(!strcmp("check_status", $func)){
		$result = check_status($_POST['table'], $_POST['order_id'], $_POST['status']);
	}
	else{
		echo "function_name not found.";
		return;
	}
  echo $result;

	return $result;
?>
