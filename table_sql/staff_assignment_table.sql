CREATE TABLE `staff_assignment`(
  `order_id` int(10),
  `staff_id` int(10),
  PRIMARY KEY (order_id, staff_id),
  FOREIGN KEY (order_id)
  REFERENCES orders(order_id) ON DELETE CASCADE,
  FOREIGN KEY (staff_id)
  REFERENCES staff(staff_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
