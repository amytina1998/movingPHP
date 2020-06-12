/*客戶*/
CREATE TABLE`client`(
	`client_id`  int(10) NOT NULL,						/*客戶ID*/
	`connect_way`  varchar(100) CHARACTER SET utf8, 	/*聯絡方式*/
	`connect_time`  varchar(100) CHARACTER SET utf8,	/*聯絡時間*/
	PRIMARY KEY(client_id)
	)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;