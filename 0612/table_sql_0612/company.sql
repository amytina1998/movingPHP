CREATE TABLE `company`( /*公司*/
  `company_id`   int(10)      NOT NULL AUTO_INCREMENT, /*公司ID*/
  `company_name` varchar(100) CHARACTER SET utf8, /*公司名稱*/
  PRIMARY KEY (company_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
