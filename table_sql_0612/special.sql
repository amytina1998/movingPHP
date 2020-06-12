CREATE TABLE`special`( /*特殊物品*/
	`special_id`  int(10) NOT NULL, /*特殊物品ID*/
	`order_id`  	int(10), 					/*訂單ID*/
	`name` 				varchar(100) CHARACTER SET utf8, 	/*物品名稱*/
	`num` 				int(10), 					/*數量*/  /*擅自增加的，不確定是否需要*/
	PRIMARY KEY(special_id),
	FOREIGN KEY(order_id)
	REFERENCES orders(order_id) ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
