<?php

  function all_user_data(){
    require './connDB.php';

    $sql_query = "SELECT * FROM `member`";
    $result = mysqli_query($db_link, $sql_query);
    mysqli_close($db_link);
    return $result;
  }

  function user_data(){
    $sql_query = "SELECT * FROM `member` WHERE `member_id` = '1'";
    return $sql_query;
  }


?>
