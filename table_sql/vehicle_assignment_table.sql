CREATE TABLE `vehicle_assignmemt`(
  `order_id` int(10),
  `vehicle_id` int(10),
  `num` int(10),
  PRIMARY KEY (order_id, vehicle),
  FOREIGN KEY (order_id)
  REFERENCES `order`(order_id) ON DELETE CASCADE,
  FOREIGN KEY (vehicle_id)
  REFERENCES `vehicle`(vehicle_id) ON DELETE SET NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
