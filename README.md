# webapp-forgotpassword

## mysql
		CREATE TABLE users (
		  user_id INT(3) AUTO_INCREMENT PRIMARY KEY, 
		  user_name VARCHAR(255),
		  user_pass VARCHAR(255), 
		  user_lvl INT(2),
		  cust_id INT(4),
		  is_approved INT(1)
		);

		CREATE TABLE customers (
			cust_id INT(3) AUTO_INCREMENT PRIMARY KEY,
			cust_lname VARCHAR(255),
			cust_fname VARCHAR(255),
			cust_bday DATE, 
			cust_gender VARCHAR(10),
			cust_address VARCHAR(255),
			cust_phone VARCHAR(30),
			cust_email VARCHAR(39),
			cust_dateRegistered DATETIME,
			cust_dateApproved DATETIME
		);
