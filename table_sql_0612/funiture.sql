CREATE TABLE `furniture` (
	`furniture_id`		int(10)     NOT NULL AUTO_INCREMENT,
	`type`     enum('room', 'livingRoom', 'outdoor'),	   /*空間類別*/
	`furniture_name`	varchar(99) CHARACTER SET utf8,    /*家具名稱*/
	`picture`       varchar(99) ,            /*圖片,是這樣寫嗎?*/
	PRIMARY KEY (furniture_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;