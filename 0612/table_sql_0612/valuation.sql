CREATE TABLE `valuation` ( /*估價單*/
    `valuation_id` int(10) NOT NULL AUTO_INCREMENT, /*估價單ID*/
    `order_id`     int(10),             /*訂單ID(搬家資料)*/
    `carton_num`   int(10) NOT NULL,    /*紙箱數量*/
    `self_valuation_progress` int(2),   /*自助估價進度(存網頁填寫資料到什麼地方)*/
    `status` enum('self', 'booking', 'match', 'cancel', 'chosen'), /*估價單的狀態, chosen狀態代表已變成訂單*/
  PRIMARY KEY (valuation_id),
  FOREIGN KEY (order_id)
  REFERENCES orders(order_id) ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
