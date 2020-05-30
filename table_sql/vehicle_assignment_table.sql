CREATE TABLE `vehicle_assignment`(
  `order_id` int(10),   /*訂單*/
  `vehicle_id` int(10), /*車子*/
  `num` int(10),        /*數量*/
  PRIMARY KEY (order_id, vehicle_id),
  FOREIGN KEY (order_id)
  REFERENCES orders(order_id) ON DELETE CASCADE,
  FOREIGN KEY (vehicle_id)
  REFERENCES vehicle(vehicle_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
