# webapp-forgotpassword

## mysql
		CREATE TABLE users (
		  user_id INT(3) AUTO_INCREMENT PRIMARY KEY, 
		  user_name VARCHAR(255),
		  user_pass VARCHAR(255), 
		  user_lvl INT(2),
		  cust_id INT(4),
		  is_approved INT(1)
			primary key (user_id)
		);
