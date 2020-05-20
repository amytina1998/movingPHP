CREATE TABLE `self_valuation` (
  `self_valuation_id`     int(10)     NOT NULL AUTO_INCREMENT,
  `order_id`              int(10),
  `contact_time`          varchar(99) CHARACTER SET utf8,
  `prefer_valuation_time` datetime,
  `internet_price`        int(10),
  PRIMARY KEY (self_valuation_id),
  FOREIGN KEY (order_id)
  REFERENCES orders(order_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
