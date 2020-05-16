CREATE TABLE `vehicle`(
  `vehicle_id` int(10) NOT NULL AUTO_INCREMENT,
  `plate_num` varchar(99) NOT NULL, /*車牌號碼*/
  `vehicle_weight` varchar(10), /*車輛噸位*/
  `vehicle_type` varchar(99)  CHARACTER SET utf8, /*車輛種類*/
  PRIMARY KEY (vehicle_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/* type
Sedan 轎車
Hatchback 掀背車
Coupes 轎跑車
Wagons 旅行車
Sports Car 跑車
Van 箱型車
Convertibles 敞篷車
Truck 貨卡車
Recreation Vehicle (RV) 休旅車
Sport Utility Vehicle (SUV) 運動型多用途車
Bus 公車
Others 其他(露營車、軌道車)
*/
