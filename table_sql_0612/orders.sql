CREATE TABLE `orders`(
  `order_id`          int(10) NOT NULL AUTO_INCREMENT, /*訂單ID*/
  `member_id`         int(10),  /*客戶ID*/
  `company_id`        int(10),  /*公司ID*/
  `moving_date`       datetime, /*搬家時間*/
  `additional`        varchar(300) CHARACTER SET utf8, /*補充，注意事項*/
  `memo`              varchar(300) CHARACTER SET utf8, /*備註*/
  `estimate_worktime` int(3), /*預計工時*/
  `storage_space`     varchar(10) CHARACTER SET utf8 NOT NULL, /*倉儲需求*/
  `program`           varchar(4) CHARACTER SET utf8 NOT NULL, /*方案名稱*/
  `fee`               int(10), /*搬家費用*/
  `status`            enum('evaluating', 'scheduled', 'assigned', 'done', 'cancel'), /*訂單狀態*/
  `new`               boolean      DEFAULT TRUE, /*有無按過*/
  `last_update`       timestamp NOT NULL DEFAULT current_timestamp()
  ON UPDATE current_timestamp(), /*更新時間*/
  PRIMARY KEY (order_id),
  FOREIGN KEY (member_id)
  REFERENCES member(member_id) ON DELETE SET NULL,
  FOREIGN KEY (company_id)
  REFERENCES company(company_id)
);