CREATE TABLE`room`( /*房間*/
	`room_id`  int(10) NOT NULL, /*房間ID*/
	`order_id` int(10), 	 		 	 /*訂單ID*/
	`floor`  	 int(10), 				 /*樓層*/
	`room_name`  	 int(10),  	 	 /*房間名稱*/
	`room_type`  enum('room', 'livingRoom', 'outdoor'),  /*房間類別*/
	PRIMARY KEY(room_id),
	FOREIGN KEY(order_id)
	REFERENCES orders(order_id) ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
