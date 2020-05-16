CREATE TABLE `member`(
  `member_id`       int(1)       NOT NULL AUTO_INCREMENT,
  `name`            varchar(99)  NOt NULL,
  `gender`          varchar(10),
  `phone`           char(10),
  `contact_address` varchar(100) CHARACTER SET utf8,
  PRIMARY KEY(member_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
