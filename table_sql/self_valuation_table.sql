CREATE TABLE `self_valuation` (
  `self_valuation_id`     int(10)     NOT NULL AUTO_INCREMENT, /*自助估價單id*/
  `order_id`              int(10), /*訂單資訊*/
  `contact_time`          varchar(99) CHARACTER SET utf8, /*聯絡時間*/
  `prefer_valuation_time` datetime, /*偏好估價時間*/
  `internet_price`        int(10), /*線上估價*/
  PRIMARY KEY (self_valuation_id),
  FOREIGN KEY (order_id)
  REFERENCES orders(order_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
