CREATE TABLE `member`( /*客戶*/
	`member_id`  		int(10) NOT NULL,	/*客戶ID*/
	`member_name`   varchar(50)  CHARACTER SET utf8,  /*客戶名稱*/
	`gender`        varchar(10), /*性別*/
	`phone`         char(10), 	 /*電話號碼*/
	`contact_address` varchar(100) CHARACTER SET utf8, /*聯絡地址*/
	`connect_way`   varchar(100) CHARACTER SET utf8, 	/*聯絡方式*/
	`connect_time`  varchar(100) CHARACTER SET utf8,	/*聯絡時間*/
	PRIMARY KEY(member_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
