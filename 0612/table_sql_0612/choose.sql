CREATE TABLE `choose`( /*估價單-公司表*/
    `valuation_id`     int(10) NOT NULL, /*估價單ID*/
    `company_id`       int(10),     /*公司ID*/
    `valuation_date`   date,        /*估價日期*/
    `valuation_time`   varchar(99), /*估價時間*/
    `estimate_fee`     int(10),     /*估價價格*/
    `confirm`          boolean,     /*確認*/
    `choose`           enum('none', 'choose', 'cancel'), /*選擇*/
    PRIMARY KEY(valuation_id, company_id),
    FOREIGN KEY (valuation_id)
    REFERENCES valuation(valuation_id) ON DELETE CASCADE,
    FOREIGN KEY (company_id)
    REFERENCES company(company_id) ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
