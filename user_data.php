<?php
	header("Content-Type: text/html; charset=utf-8");
	require 'data_sql.php';

	$result = all_user_data();

	for($i = 0; $i < $result->num_rows; $i++)
		$row_result[] = mysqli_fetch_assoc($result);

	$result_json = json_encode($row_result);
	echo $result_json;

	return $result_json;
?>
