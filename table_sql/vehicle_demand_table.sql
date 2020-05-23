CREATE TABLE `vehicle_demand`(
  `order_id` int(10), /*訂單&估價單*/
  `num` int(10),      /*數量*/
  `vehicle_weight` varchar(10), /*車輛噸位*/
  `vehicle_type`   varchar(99)  CHARACTER SET utf8, /*車輛種類*/
  PRIMARY KEY (order_id, vehicle_weight, vehicle_type),
  FOREIGN KEY (order_id)
  REFERENCES orders(order_id) ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
