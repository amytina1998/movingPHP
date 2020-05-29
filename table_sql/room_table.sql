CREATE TABLE `room` (
	`room_id`  int(10)     NOT NULL AUTO_INCREMENT,
	`order_id` int(10),	  				 /*訂單*/
	`floor`    int(10),  					 /*樓層*/
	`name`     varchar(99) CHARACTER SET utf8,     /*房間名稱*/
	PRIMARY KEY (room_id),
	FOREIGN KEY (order_id)
	REFERENCES orders(order_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
