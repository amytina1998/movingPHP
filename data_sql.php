<?php

  function all_user_data(){
    $sql_query = "SELECT * FROM `member`;";
    $result = query($sql_query);
    return $result;
  }

  function user_data($member_id){
    $sql_query = "SELECT * FROM `member` WHERE member_id = '".$member_id."';";
    $result = query($sql_query);
    return $result;
  }

  function order_member($status){
    $sql_query = "SELECT * FROM `member` NATURAL JOIN `orders` ";
    if($status) $sql_query .= "WHERE status = '".$status."';";
    $result = query($sql_query);
    return $result;
  }

  function order_member_today(){
    //使用GMT+8
    $sql_query = "SELECT * FROM `member` NATURAL JOIN `orders` ";
    $sql_query .= "WHERE moving_date >= DATE(UTC_TIMESTAMP() + INTERVAL 8 HOUR) ";
    $sql_query .= "AND moving_date < ";
    $sql_query .= "DATE(UTC_TIMESTAMP() + INTERVAL 8 HOUR) + INTERVAL 1 DAY ";
    $sql_query .= "AND (status = 'scheduled' OR status = 'assigned');";
    $result = query($sql_query);
    return $result;
  }

  function order_detail($order_id){
    $sql_query = "SELECT * FROM `member` NATURAL JOIN ";
    $sql_query .="(`orders` LEFT OUTER JOIN ";
    $sql_query .="(`vehicle_assignment` NATURAL JOIN `vehicle`) ";
    $sql_query .="ON orders.order_id = vehicle_assignment.order_id) ";
    $sql_query .="WHERE orders.order_id = '".$order_id."';";
    $result = query($sql_query);
    return $result;
  }

  function valuation_member($status){
    $sql_query = "SELECT * FROM `member` NATURAL JOIN ";
    $sql_query .= "(`orders` INNER JOIN ";
    $sql_query .= "(`valuation` NATURAL JOIN `valuation_company`) ";
    $sql_query .= "ON orders.order_id = valuation.order_id) ";
    $sql_query .= "WHERE valuation_company.company_id = '1' ";
    $sql_query .= "AND valuation.status = '".$status."';";
    $result = query($sql_query);
    return $result;
  }

  function valuation_detail($order_id){
    $sql_query = "SELECT * FROM `member` NATURAL JOIN ";
    $sql_query .= "((`orders` INNER JOIN `valuation` ";
    $sql_query .= "ON orders.order_id = valuation.order_id) ";
    $sql_query .= "LEFT OUTER JOIN `vehicle_demand` ";
    $sql_query .= "ON orders.order_id = vehicle_demand.order_id) ";
    $sql_query .= "WHERE orders.order_id = '".$order_id."';";
    $result = query($sql_query);
    return $result;
  }

  function query($sql_query){
    require './connDB.php';
    $result = mysqli_query($db_link, $sql_query);
    mysqli_close($db_link);
    return $result;
  }


?>
