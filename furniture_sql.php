<?php

  function furniture_detail($order_id){
    $sql_query = "SELECT name, sum(num) AS num ";
    $sql_query .= "FROM `furniture` ";
    $sql_query .= "WHERE order_id = ".$order_id." ";
    $sql_query .= "GROUP BY name;";
    $result = query($sql_query);
    return $result;
  }

  function furniture_each_detail($order_id){
    $sql_query = "SELECT * FROM `furniture` ";
    $sql_query .= "WHERE order_id = ".$order_id.";";
    $result = query($sql_query);
    return $result;
  }

  function furniture_room_detail($order_id){
    $sql_query = "SELECT * FROM `furniture` ";
    $sql_query .= "JOIN `room` ";
    $sql_query .= "ON furniture.room_id = room.room_id ";
    $sql_query .= "WHERE furniture.order_id = ".$order_id." ";
    $sql_query .= "ORDER BY floor ASC;";
    $result = query($sql_query);
    return $result;
  }

  function add_furniture($order_id, $name, $num){
    $sql_query = "INSERT INTO `furniture` ";
    $sql_query .= "(`order_id`, `room_id`, `name`, `num`) VALUES ";
    $sql_query .= "(".$order_id.", null, '".$name."', ".$num.");";
    $result = query($sql_query);
    if(!strcmp($result, "1")) return "success";
  	else return $result;
  }

  function update_furniture($furniture_id, $name, $num){
  	$sql_query = "UPDATE `furniture` SET ";
  	$sql_query .= "name = '".$name."', ";
  	$sql_query .= "num = ".$num." ";
  	$sql_query .= "WHERE furniture_id = ".$furniture_id.";";
    $result = query($sql_query);
  	if(!strcmp($result, "1")) return "success";
  	else return $result;
  }

  function delete_furniture($furniture_id){
    $sql_query = "DELETE FROM `furniture` ";
    $sql_query .= "WHERE furniture_id = ".$furniture_id.";";
    $result = query($sql_query);
    if(!strcmp($result, "1")) return "success";
  	else return $result;
  }

  function query($sql_query){
    require './connDB.php';
    $result = mysqli_query($db_link, $sql_query);
    mysqli_close($db_link);
    return $result;
  }


?>
