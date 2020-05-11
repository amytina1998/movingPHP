<?php
	header("Content-Type: text/html; charset=utf-8");

	//資料庫主機設定
	$db_host = "localhost";
	$db_username = "root";
	$db_password = "";

	$db_link = @mysqli_connect($db_host, $db_username, $db_password);
	if (!$db_link) die("資料連結失敗！");
	//else echo "資料連結成功";
	mysqli_query($db_link, "SET NAMES 'utf8'");

	$seldb = @mysqli_select_db($db_link, "598_movingApp");
	//$seldb = @mysqli_select_db($db_link, "598");
	if (!$seldb) die("資料庫選擇失敗！");

	$sql_query = "SELECT * FROM `member`";
	$result = mysqli_query($db_link, $sql_query);

	//echo "result->num_rows=".$result->num_rows;
	for($i = 0; $i < $result->num_rows; $i++){ //將資料放入array
		$row_result[] = mysqli_fetch_assoc($result);
	}
	//print_r($row_result);

	$result_json = json_encode($row_result); //將array轉成json
	echo $result_json;

	return $result_json;
?>
</table>
</body>
</html>
