<?php

  function all_user_data(){
    $sql_query = "SELECT * FROM `member`";
    $result = query($sql_query);
    return $result;
  }

  function user_data(){
    $sql_query = "SELECT * FROM `member` WHERE `member_id` = '1'";
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
