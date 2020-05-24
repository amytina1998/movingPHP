<?php

function change_status($table, $order_id, $status){
	$sql_query = "UPDATE `".$table."` ";
	$sql_query .="SET status = '".$status."' ";
	$sql_query .="WHERE order_id = '".$order_id."';";
	$result = query($sql_query);
  return check_status($table, $order_id, $status);
}

function check_status($table, $order_id, $status){
  $sql_query = "SELECT status FROM `".$table."` ";
  $sql_query .= "WHERE order_id = '".$order_id."';";
  $result = query($sql_query);
  $row_result = mysqli_fetch_assoc($result);
  if(!strcmp($row_result['status'], $status)) return "success";
  else return "failed";
}

function query($sql_query){
  require './connDB.php';
  $result = mysqli_query($db_link, $sql_query);
  mysqli_close($db_link);
  return $result;
}
?>
