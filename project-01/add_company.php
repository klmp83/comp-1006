<?php
	/*
	CREATE TABLE company (
			id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
			company_name VARCHAR(70) NOT NULL,
			total_stock INT NOT NULL,
			net_capital DECIMAL(15,2) NOT NULL,
			date_of_establishment DATE NOT NULL
	);
	*/
	// used for sending the result of validation to the result page
	session_start();
	
	// flag for validation
	$validation = true;
	$error_msg = "";
		
	// assign our values to variables
	$company_name = $_POST["company_name"]; // VARCHAR(70) NOT NULL
	$total_stock = $_POST["total_stock"]; // INT NOT NULL
	$net_capital = $_POST["net_capital"]; // DECIMAL(15,2) NOT NULL
	$date_of_establishment = $_POST["date_of_establishment"]; // DATE NOT NULL
	
	// check invalid parameters and sanitize them
	if (empty($company_name)) {
		$error_msg .= "You must enter a company name<br />";
		$validation = false;
	} else {
		$company_name = filter_var($company_name, FILTER_SANITIZE_STRING);
	}
	if (empty($total_stock)) {
		$error_msg .= "You must enter a total stock<br />";
		$validation = false;
	} if (is_numeric($total_stock) == false) { // is_int() can not be used since it checks type not only value
		$error_msg .= "You must enter a total stock as a integer<br />";
		$validation = false;
	} else {
		$total_stock = filter_var($total_stock, FILTER_SANITIZE_NUMBER_INT);
	}
	if (empty($net_capital)) {
		$error_msg .= "You must enter a net capital<br />";
		$validation = false;
	} if (is_numeric($net_capital) == false) {
		$error_msg .= "You must enter a net capital as a number<br />";
		$validation = false;
	} else {
		$net_capital = filter_var($net_capital, FILTER_SANITIZE_NUMBER_FLOAT);
	}
	if (empty($date_of_establishment)) {
		$error_msg .= "You must enter a date of establishment<br />";
		$validation = false;
	} else {
		$date_of_establishment = filter_var($date_of_establishment, FILTER_SANITIZE_STRING);
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
	$sql = "INSERT INTO company (company_name, total_stock, net_capital, date_of_establishment) VALUES (:company_name, :total_stock, :net_capital, :date_of_establishment)";
	
	// prepare the SQL statement
	$sth = $dbh->prepare($sql);
	
	// fill the placehoders
	$sth->bindParam(":company_name", $company_name, PDO::PARAM_STR, 70);
	$sth->bindParam(":total_stock", $total_stock, PDO::PARAM_INT);
	$sth->bindParam(":net_capital", $net_capital, PDO::PARAM_STR, 15);
	$sth->bindParam(":date_of_establishment", $date_of_establishment, PDO::PARAM_STR);
	
	// execute the SQL
	$sth->execute();
	
	// close the DB connection
	$dbh = null;
	
	// save a massage in the session
	$_SESSION["success"] = "A company was added successfully.<br />";
	header("Location: confirmed.php");
?>