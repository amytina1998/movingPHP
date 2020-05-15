CREATE TABLE `order`(
  `order_id`          int(10) NOT NULL AUTO_INCREMENT,
  `member_id`         int(11) NOT NULL,
  `moving_date`       date,
  `moving_time`       time,
  `moveout_address`   varchar(100) CHARACTER SET utf8,
  `movein_address`    varchar(100) CHARACTER SET utf8,
  `additional`        varchar(300) CHARACTER SET utf8,
  `estimate_worktime` time         CHARACTER SET utf8,
  `fee` int(10),
  PRIMARY KEY(order_id);
  FOREIGN KEY (member_id)
  REFERENCES member(member_id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
