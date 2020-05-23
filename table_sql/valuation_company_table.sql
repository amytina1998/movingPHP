CREATE TABLE `valuation_company`(
  `valuation_id` int(10), /*估價單*/
  `company_id` int(10),   /*公司*/
  PRIMARY KEY (valuation_id, company_id),
  FOREIGN KEY (valuation_id)
  REFERENCES valuation(valuation_id) ON DELETE CASCADE,
  FOREIGN KEY (company_id)
  REFERENCES company(company_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
