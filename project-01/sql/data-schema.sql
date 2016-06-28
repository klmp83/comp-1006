USE acsm_855816b26cc82d2;
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS company;
CREATE TABLE company (
	id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	company_name VARCHAR(70) NOT NULL,
	total_stock INT NOT NULL,
	net_capital DECIMAL(15,2) NOT NULL,
	date_of_establishment DATE NOT NULL
);

DROP TABLE IF EXISTS employee;
CREATE TABLE employee (
	id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	first_name VARCHAR(70) NOT NULL,
	last_name VARCHAR(70) NOT NULL,
	date_of_birth DATE DEFAULT NULL,
	company_id INT(11) DEFAULT NULL,
	CONSTRAINT fk_company_id FOREIGN KEY (company_id)
		REFERENCES company(id)
		ON UPDATE CASCADE
		ON DELETE CASCADE
);

SET FOREIGN_KEY_CHECKS = 1;

select * from company;
select * from employee;