CREATE TABLE `valuation` (
  `valuation_id`   int(10)   NOT NULL AUTO_INCREMENT,
  `order_id`       int(10),         /*訂單資料(主要資料)*/
  `contact_time`   datetime,        /*聯絡時間*/
  `prefer_valuation_time` datetime, /*偏好估價時間*/
  `internet_price` int(10),         /*線上估價價格*/
  `valuation_time` datetime,        /*估價時間*/
  `status`         enum('self', 'booking', 'match', 'chosen', 'cancel'), /*狀態*/
  PRIMARY KEY (valuation_id),
  FOREIGN KEY (order_id)
  REFERENCES orders(order_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
