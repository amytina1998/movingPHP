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
    $sql_query .= "LEFT OUTER JOIN `room` ";
    $sql_query .= "ON furniture.room_id = room.room_id ";
    $sql_query .= "WHERE furniture.order_id = ".$order_id." ";
    $sql_query .= "ORDER BY floor ASC;";
    $result = query($sql_query);
    return $result;
  }

  function modify_furniture($order_id, $furniture_data){
		$arr = json_decode($furniture_data);
		foreach ($arr as $count => $row_data){
			$furniture_id = $row_data[0];
			$name = $row_data[1];
			$num = $row_data[2];

			if($num == 0)
				$check[$count] = delete_furniture($furniture_id);
			else{
				if(strcmp(search_furniture($furniture_id), "success")){
		    		$result = add_furniture($order_id, $name, $num);
		    		if(!strcmp($result, "success")) $check[$count] =  "success";
					else $check[$count] =  $result;
				}
				else
					$check[$count] =  update_furniture($furniture_id, $name, $num);
			}
		}
		if(count(array_unique($check))===1 && end($check)==="success")
			return "success";
		else return $check;
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

  function search_furniture($furniture_id){
		$sql_query = "SELECT furniture_id FROM `furniture` ";
		$sql_query .= "WHERE furniture_id = ".$furniture_id.";";
		$result = query($sql_query);
    $row_result[] = mysqli_fetch_assoc($result);
		if(!strcmp($row_result['furniture_id'], $furniture_id))
      return "success";
	  else return $result;
	}

  function query($sql_query){
    require './connDB.php';
    $result = mysqli_query($db_link, $sql_query);
    mysqli_close($db_link);
    return $result;
  }


?>
