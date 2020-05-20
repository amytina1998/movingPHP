CREATE TABLE `valuation` (
  `valuation_id`   int(10)   NOT NULL AUTO_INCREMENT,
  `order_id`       int(10),
  `company_id`     int(10),
  `valuation_time` datetime,
  `status`         enum('booking', 'match', 'cancel'),
  PRIMARY KEY (valuation_id),
  FOREIGN KEY (order_id)
  REFERENCES orders(order_id) ON DELETE CASCADE,
  FOREIGN KEY (company_id)
  REFERENCES company(company_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
