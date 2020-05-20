CREATE TABLE `self_valuation_company`(
  `self_valuation_id` int(10),
  `company_id` int(10),
  `status` enum('null', 'chosen', 'unchosen'),
  PRIMARY KEY (self_valuation_id),
  FOREIGN KEY (company_id)
  REFERENCES company(company_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
