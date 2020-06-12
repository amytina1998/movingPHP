CREATE TABLE `furniture_list` (
	`furniture_id`		int(10),
	`order_id`     		int(10),						  /*訂單*/
	`room_id`     		int(10),                                                  /*房間ID*/
	`company_id`            int(20),                                                  /*公司ID*/
	`num`          		int(10),						  /*家具數量*/
	`furniture_memo`	varchar(99) CHARACTER SET utf8, /*家具備註*/
	PRIMARY KEY (furniture_id,order_id),
	FOREIGN KEY (furniture_id)
	REFERENCES furniture(furniture_id) ON DELETE CASCADE,  /*這樣設對嗎?*/
	FOREIGN KEY (order_id)
	REFERENCES orders(order_id) ON DELETE CASCADE,
	FOREIGN KEY (room_id)
	REFERENCES room(room_id) ON DELETE SET NULL,
	FOREIGN KEY (company_id)
	REFERENCES company(company_id) ON DELETE SET NULL /*這樣設對嗎?*/
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;