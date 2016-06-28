<?php
	/* 
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
	*/
	// used for sending the result of validation to the result page
	session_start();
	
	// flag for validation
	$validation = true;
	$error_msg = "";
	
	// assign our values to variables
	$first_name = $_POST["first_name"]; // VARCHAR(70) NOT NULL
	$last_name = $_POST["last_name"]; // VARCHAR(70) NOT NULL
	$date_of_birth = $_POST["date_of_birth"]; // DATE DEFAULT NULL
	$company_id = $_POST["company_id"]; // INT(11) DEFAULT NULL
	
	// check invalid parameters and sanitize them
	if (empty($first_name)) {
		$error_msg .= "You must enter a first name<br />";
		$validation = false;
	} else {
		$first_name = filter_var($first_name, FILTER_SANITIZE_STRING);
	}
	if (empty($last_name)) {
		$error_msg .= "You must enter a last name<br />";
		$validation = false;
	} else {
		$last_name = filter_var($last_name, FILTER_SANITIZE_STRING);
	}
	if (empty($date_of_birth)) {
		$error_msg .= "You must enter a date of birth<br />";
		$validation = false;
	} else {
		$date_of_birth = filter_var($date_of_birth, FILTER_SANITIZE_STRING);
	}
	if (empty($company_id)) {
		$error_msg .= "You must enter a total stock<br />";
		$validation = false;
	} if (is_numeric($company_id) == false) { // is_int() can not be used since it checks type not only value
		$error_msg .= "You must enter a total stock as a integer<br />";
		$validation = false;
	} else {
		$company_id = filter_var($company_id, FILTER_SANITIZE_NUMBER_INT);
	}
	
	// if validation is failed, move confirmed page with error message
	if ($validation == false) {
		$_SESSION["fail"] = $error_msg;
		header("Location: confirmed.php");
		exit;
	}
	
	// connect to the database
	require_once (dirname(__FILE__) . "/shared/connect.php");
	
	// build the SQL statement
	$sql = "INSERT INTO employee (first_name, last_name, date_of_birth, company_id) VALUES (:first_name, :last_name, :date_of_birth, :company_id)";
	
	// prepare the SQL statement
	$sth = $dbh->prepare($sql);
	
	// fill the placehoders
	$sth->bindParam(":first_name", $first_name, PDO::PARAM_STR, 70);
	$sth->bindParam(":last_name", $last_name, PDO::PARAM_STR, 70);
	$sth->bindParam(":date_of_birth", $date_of_birth, PDO::PARAM_STR);
	$sth->bindParam(":company_id", $company_id, PDO::PARAM_INT, 11);
	
	// execute the SQL
	$sth->execute();
	
	// close the DB connection
	$dbh = null;
	
	// save a massage in the session
	$_SESSION["success"] = "A employee was added successfully.<br />";
	header("Location: confirmed.php");
?>