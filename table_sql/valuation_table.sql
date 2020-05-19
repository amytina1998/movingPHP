CREATE TABLE `valuation` (
  `valuation_id` int(10) NOT NULL AUTO_INCREMENT,
  `order_id` int(10),
  `valuation_time` datetime,
  `contact_time` varchar(99) CHARACTER SET utf8,
  `internet_price` int(10),
  PRIMARY KEY (valuation_id),
  FOREIGN KEY (order_id)
  REFERENCES orders(order_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
