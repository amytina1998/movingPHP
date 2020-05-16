CREATE TABLE `order`(
  `order_id`          int(10) NOT NULL AUTO_INCREMENT,
  `member_id`         int(11),
  `moving_date`       date, /*搬家日期*/
  `moving_time`       time, /*搬家時間*/
  `moveout_address`   varchar(100) CHARACTER SET utf8, /*搬出地址*/
  `movein_address`    varchar(100) CHARACTER SET utf8, /*搬入地址*/
  `additional`        varchar(300) CHARACTER SET utf8, /*補充，注意事項*/
  `estimate_worktime` time, /*預計工時*/
  `fee` int(10), /*費用*/
  `status` enum('scheduled', 'assigned', 'cancel'), /*訂單狀態*/
  PRIMARY KEY (order_id),
  FOREIGN KEY (member_id)
  REFERENCES member(member_id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
