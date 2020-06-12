/*搬家地點*/
CREATE TABLE`moving_address`(
	`order_id`  int(10),  							/*訂單ID*/
	`address`  varchar(100) CHARACTER SET utf8,  	/*地址*/
	`elevator`  boolean,  							/*是否有電梯*/  /*不確定是否需要預設值?*/
	`from_or_to`  enum('from', 'to'),   			/*搬出或搬入*/  /*不知道該取甚麼名字*/
	PRIMARY KEY(order_id,from_or_to),
	FOREIGN KEY(order_id)
	REFERENCES orders(order_id) ON DELETE CASCADE
	)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
