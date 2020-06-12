<?php

  function order_member($company_id, $startDate, $endDate, $status, $new){
    $sql_query = "SELECT * FROM (`member` NATURAL JOIN `orders`) ";
    $sql_query .= "NATURAL JOIN `company` ";
    $sql_query .= "WHERE orders.company_id = ".$company_id." ";
    $sql_query .= "AND moving_date > '".$startDate."' ";
    $sql_query .= "AND moving_date < '".$endDate." 23:59:59' ";
    $sql_query .= "AND status = '".$status."'";
    $sql_query .= "AND new = ".$new.";";
    $result = query($sql_query);
    return $result;
  }//改

  function order_member_today($company_id){
    //使用GMT+8
    $sql_query = "SELECT * FROM (`member` NATURAL JOIN `orders`) ";
    $sql_query .= "NATURAL JOIN `company` ";
    $sql_query .= "WHERE orders.company_id = ".$company_id." ";
    $sql_query .= "AND moving_date >= DATE(UTC_TIMESTAMP() + INTERVAL 8 HOUR) ";
    $sql_query .= "AND moving_date < ";
    $sql_query .= "DATE(UTC_TIMESTAMP() + INTERVAL 8 HOUR) + INTERVAL 1 DAY ";
    $sql_query .= "AND (status = 'scheduled' OR status = 'assigned');";
    $result = query($sql_query);
    return $result;
  }//改

  function order_detail($order_id){
    $sql_query = "SELECT * FROM `member` NATURAL JOIN `orders` ";
    $sql_query .= "WHERE orders.order_id = '".$order_id."';";
    $result = query($sql_query);
    return $result;
  }

  function address_detail($order_id){
    $sql_query = "SELECT * FROM `moving_address` ";
    $sql_query .= "WHERE order_id = ".$order_id.";";
    $result = query($sql_query);
    return $result;
  }//新

  function vehicle_detail($order_id){
    $sql_query = "SELECT vehicle_weight, vehicle_type, COUNT(*) AS num ";
    $sql_query .= "FROM `vehicle_assignment` NATURAL JOIN `vehicle` ";
    $sql_query .= "WHERE order_id = ".$order_id." ";
    $sql_query .= "GROUP BY vehicle_weight, vehicle_type;";
    $result = query($sql_query);
    return $result;
  }//沒表

  function staff_detail($order_id){
    $sql_query = "SELECT * FROM `staff` NATURAL JOIN `staff_assignment` ";
    $sql_query .= "WHERE staff_assignment.order_id = ".$order_id.";";
    $result = query($sql_query);
    return $result;
  }//沒表

  function valuation_member($company_id, $startDate, $endDate, $status, $new){
    $sql_query = "SELECT * FROM `member` NATURAL JOIN ";
    $sql_query .= "(`orders` INNER JOIN ";
    $sql_query .= "(`valuation` NATURAL JOIN `choose`) ";
    $sql_query .= "ON orders.order_id = valuation.order_id) ";
    $sql_query .= "WHERE choose.company_id = ".$company_id." ";
    $sql_query .= "AND valuation_date > '".$startDate."' ";
    $sql_query .= "AND valuation_date < '".$endDate." 23:59:59' ";
    $sql_query .= "AND (valuation.status = '".$status."' ";
    if (!strcmp("cancel", $status))
     $sql_query .= "OR choose.choose = '".$status."') ";
    else $sql_query .= ") ";
    $sql_query .= "AND new = ".$new.";";
    $result = query($sql_query);
    return $result;
  }//改

  function self_valuation_member($company_id, $startDate, $endDate, $new){
    $sql_query = "SELECT * FROM `member` NATURAL JOIN ";
    $sql_query .= "(`orders` INNER JOIN ";
    $sql_query .= "(`valuation` NATURAL JOIN `choose`) ";
    $sql_query .= "ON orders.order_id = valuation.order_id) ";
    $sql_query .= "WHERE choose.company_id = ".$company_id." ";
    $sql_query .= "AND last_update > '".$startDate."' ";
    $sql_query .= "AND last_update < '".$endDate." 23:59:59' ";
    $sql_query .= "AND new = ".$new.";";
    $result = query($sql_query);
    return $result;
  }//改

  function valuation_detail($order_id){
    $sql_query = "SELECT * FROM `member` NATURAL JOIN ";
    $sql_query .= "((`orders` INNER JOIN ";
    $sql_query .= "(`valuation` NATURAL JOIN `choose`) ";
    $sql_query .= "ON orders.order_id = valuation.order_id) ";
    $sql_query .= "LEFT OUTER JOIN `vehicle_demand` ";
    $sql_query .= "ON orders.order_id = vehicle_demand.order_id) ";
    $sql_query .= "WHERE orders.order_id = ".$order_id.";";
    $result = query($sql_query);
    return $result;
  }

  function all_staff_data(){
    $sql_query = "SELECT * FROM `staff`;";
    $result = query($sql_query);
    return $result;
  }//沒表

  function all_vehicle_data(){
    $sql_query = "SELECT * FROM `vehicle`;";
    $result = query($sql_query);
    return $result;
  }//沒表

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

  function query($sql_query){
    require './connDB.php';
    $result = mysqli_query($db_link, $sql_query);
    mysqli_close($db_link);
    return $result;
  }


?>
