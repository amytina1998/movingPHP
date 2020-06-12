CREATE TABLE `furniture_list` (
	`furniture_id`		int(10)     NOT NULL AUTO_INCREMENT,
	`order_id`     		int(10),						  /*訂單*/
	`room_id`     		int(10),						  /*房間ID*/
	`furniture_name`	varchar(99) CHARACTER SET utf8,    /*家具名稱*/
	`num`          		int(10),							/*家具數量*/
	`furniture_memo`	varchar(99) CHARACTER SET utf8, /*家具備註*/
	PRIMARY KEY (furniture_id),
	FOREIGN KEY (order_id)
	REFERENCES orders(order_id) ON DELETE CASCADE,
	FOREIGN KEY (room_id)
	REFERENCES room(room_id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
