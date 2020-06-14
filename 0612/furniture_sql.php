<?php

/*new*/
  function furniture_detail($order_id){
    $sql_query = "SELECT furniture_name, sum(num) AS num ";
    $sql_query .= "FROM `furniture` ";
    $sql_query .= "NATURAL JOIN `furniture_list` ";
    $sql_query .= "WHERE order_id = ".$order_id." ";
    $sql_query .= "GROUP BY name;";
    $result = query($sql_query);
    return $result;
  }

/*new*/
  function furniture_each_detail($order_id){
    $sql_query = "SELECT * FROM `furniture_list` ";
    $sql_query .= "NATURAL JOIN `furniture` ";
    $sql_query .= "WHERE order_id = ".$order_id.";";
    $result = query($sql_query);
    return $result;
  }

/*new*/
  function furniture_room_detail($order_id){
    $sql_query = "SELECT * FROM `furniture_list` ";
    $sql_query .= "NATURAL JOIN `furniture` ";
    $sql_query .= "LEFT OUTER JOIN `room` ";
    $sql_query .= "ON furniture_list.room_id = room.room_id ";
    $sql_query .= "WHERE furniture_list.order_id = ".$order_id." ";
    $sql_query .= "ORDER BY floor ASC;";
    $result = query($sql_query);
    return $result;
  }

  /*new*/
  function modify_furniture($order_id, $furniture_data){
    $arr = json_decode($furniture_data);
    foreach ($arr as $count => $row_data){
      $furniture_id = $row_data[0];
      $num = $row_data[2];

      if($num == 0)
        $check[$count] = delete_furniture($furniture_id);
      else{
        if(strcmp(search_furniture($furniture_id), "success")){
            $result = add_furniture($furniture_id, $order_id, $num);
            if(!strcmp($result, "success")) $check[$count] =  "success";
          else $check[$count] =  $result;
        }
        else
          $check[$count] =  update_furniture($furniture_id, $num);
      }
    }
    if(count(array_unique($check))===1 && end($check)==="success")
      return "success";
    else return $check;
  }

/*new*/
  function add_furniture($furniture_id, $order_id, $num){
    $sql_query = "INSERT INTO `furniture_list` ";
    $sql_query .= "(`furniture_id`, `order_id`, `room_id`, `company_id`, `num`, `furniture_memo`) VALUES "; /*room_id跟company_id都先設空值*/
    $sql_query .= "(".$furniture_id.", ".$order_id.", null, null, ".$num.", null);";
    $result = query($sql_query);
    if(!strcmp($result, "1")) return "success";
    else return $result;
  }

  /*new*/
  function update_furniture($furniture_id, $num){
    $sql_query = "UPDATE `furniture_list` SET ";
    $sql_query .= "num = ".$num." ";
    $sql_query .= "WHERE furniture_id = ".$furniture_id.";";
    $result = query($sql_query);
    if(!strcmp($result, "1")) return "success";
    else return $result;
  }

/*new*/
  function delete_furniture($furniture_id){
    $sql_query = "DELETE FROM `furniture_list` ";
    $sql_query .= "WHERE furniture_id = ".$furniture_id.";";
    $result = query($sql_query);
    if(!strcmp($result, "1")) return "success";
    else return $result;
  }

/*new*/
  function search_furniture($furniture_id){
    $sql_query = "SELECT furniture_id FROM `furniture_list` ";
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
