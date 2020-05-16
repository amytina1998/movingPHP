CREATE TABLE `member`(
  `member_id`       int(1)       NOT NULL AUTO_INCREMENT,
  `name`            varchar(99)  NOt NULL, /*姓名*/
  `gender`          varchar(10), /*性別*/
  `phone`           char(10), /*電話號碼*/
  `contact_address` varchar(100) CHARACTER SET utf8, /*聯絡地址*/
  PRIMARY KEY(member_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
