CREATE TABLE `member`( /*客戶*/
	`member_id`  			int(10)			 NOT NULL AUTO_INCREMENT,	/*客戶ID*/
	`member_name`   	varchar(50)  CHARACTER SET utf8,  /*客戶名稱*/
	`gender`       		varchar(10)  CHARACTER SET utf8, /*性別*/
	`phone`        		char(10), 	 /*電話號碼*/
	`contact_address` varchar(100) CHARACTER SET utf8, /*聯絡地址*/
	`connect_way`   	varchar(100) CHARACTER SET utf8, 	/*聯絡方式*/
	`connect_time`  	varchar(100) CHARACTER SET utf8,	/*聯絡時間*/
	PRIMARY KEY(member_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `company`( /*公司*/
  `company_id`   int(10)      NOT NULL AUTO_INCREMENT, /*公司ID*/
  `company_name` varchar(100) CHARACTER SET utf8,      /*公司名稱*/
  PRIMARY KEY (company_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `orders`(
  `order_id`          int(10) NOT NULL AUTO_INCREMENT, /*訂單ID*/
  `member_id`         int(10),  /*客戶ID*/
  `company_id`        int(10),  /*公司ID*/
  `moving_date`       datetime, /*搬家時間*/
  `additional`        varchar(300) CHARACTER SET utf8, /*補充，注意事項*/
  `memo`              varchar(300) CHARACTER SET utf8, /*備註*/
  `estimate_worktime` int(3),   /*預計工時*/
  `storage_space`     varchar(10)  CHARACTER SET utf8 NOT NULL, /*倉儲需求*/
  `program`           varchar(4)   CHARACTER SET utf8 NOT NULL, /*方案名稱*/
  `fee`               int(10),  /*搬家費用*/
  `status`            enum('evaluating', 'scheduled', 'assigned', 'done', 'cancel'), /*訂單狀態*/
  `new`               boolean   DEFAULT TRUE, /*有無按過*/
  `last_update`       timestamp NOT NULL DEFAULT current_timestamp()
                                ON UPDATE current_timestamp(),       /*更新時間*/
  PRIMARY KEY (order_id),
  FOREIGN KEY (member_id)
  REFERENCES member(member_id) ON DELETE SET NULL,
  FOREIGN KEY (company_id)
  REFERENCES company(company_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE`moving_address`( /*搬家地點*/
	`order_id`  	int(10), /*訂單ID*/
	`address` 	 	varchar(100) CHARACTER SET utf8,/*地址*/
	`elevator` 		boolean, /*是否有電梯*/
	`from_or_to`  enum('from', 'to'), /*搬出或搬入*/  /*不知道該取甚麼名字*/
	PRIMARY KEY(order_id, from_or_to),
	FOREIGN KEY(order_id)
	REFERENCES orders(order_id) ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE`special`( /*特殊物品*/
	`special_id`  int(10) NOT NULL AUTO_INCREMENT, /*特殊物品ID*/
	`order_id`  	int(10), /*訂單ID*/
	`name` 				varchar(100) CHARACTER SET utf8, /*物品名稱*/
	`num` 				int(10), /*數量*/  /*擅自增加的，不確定是否需要*/
	PRIMARY KEY(special_id),
	FOREIGN KEY(order_id)
	REFERENCES orders(order_id) ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `valuation` ( /*估價單*/
    `valuation_id` int(10) NOT NULL AUTO_INCREMENT, /*估價單ID*/
    `order_id`     int(10),             /*訂單ID(搬家資料)*/
    `carton_num`   int(10) NOT NULL,    /*紙箱數量*/
    `self_valuation_progress` int(2),   /*自助估價進度(存網頁填寫資料到什麼地方)*/
    `status` enum('self', 'booking', 'match', 'cancel', 'chosen'), /*估價單的狀態, chosen狀態代表已變成訂單*/
  PRIMARY KEY (valuation_id),
  FOREIGN KEY (order_id)
  REFERENCES orders(order_id) ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `choose`( /*估價單-公司表*/
    `valuation_id`     int(10) NOT NULL, /*估價單ID*/
    `company_id`       int(10),     /*公司ID*/
    `valuation_date`   date,        /*估價日期*/
    `valuation_time`   varchar(99), /*估價時間*/
    `estimate_fee`     int(10),     /*估價價格*/
    `confirm`          boolean,     /*確認*/
    `choose`           enum('none', 'choose', 'cancel'), /*選擇*/
    PRIMARY KEY(valuation_id, company_id),
    FOREIGN KEY (valuation_id)
    REFERENCES valuation(valuation_id) ON DELETE CASCADE,
    FOREIGN KEY (company_id)
    REFERENCES company(company_id) ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `furniture` ( /*家具*/
	`furniture_id`		int(10)     NOT NULL AUTO_INCREMENT,
	`furniture_type`  varchar(99) CHARACTER SET utf8, /*空間類別*/
	`furniture_name`	varchar(99) CHARACTER SET utf8, /*家具名稱*/
	`picture`         varchar(99), /*圖片,是這樣寫嗎?*/
	PRIMARY KEY (furniture_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE`room`( /*房間*/
	`room_id`  int(10) NOT NULL AUTO_INCREMENT, /*房間ID*/
	`order_id` int(10), 	 	/*訂單ID*/
	`floor`  	 int(10), 		/*樓層*/
	`room_name`  	 int(10), /*房間名稱*/
	`room_type`  enum('room', 'livingRoom', 'outdoor'),  /*房間類別*/
	PRIMARY KEY(room_id),
	FOREIGN KEY(order_id)
	REFERENCES orders(order_id) ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `furniture_list` ( /*家具清單*/
	`furniture_id`		int(10), 	/*家具ID*/
	`order_id`     		int(10),	/*訂單ID*/
	`room_id`     		int(10),  /*房間ID*/
	`company_id`      int(20),	/*公司ID*/
	`num`          		int(10),	/*家具數量*/
	`furniture_memo`	varchar(99) CHARACTER SET utf8, /*家具備註*/
	PRIMARY KEY (furniture_id,order_id),
	FOREIGN KEY (furniture_id)
	REFERENCES furniture(furniture_id) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (order_id)
	REFERENCES orders(order_id) ON DELETE CASCADE,
	FOREIGN KEY (room_id)
	REFERENCES room(room_id) ON DELETE SET NULL,
	FOREIGN KEY (company_id)
	REFERENCES company(company_id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
