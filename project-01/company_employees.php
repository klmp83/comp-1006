<!DOCTYPE html>
<?php
	// used for sending the result of validation to the result page
	session_start();	
	
	// flag for validation
	$validation = true;
	$error_msg = "";
	
	// assign the artis id to a variable
	$company_id = $_GET["company_id"];
	
	// check invalid parameters and sanitize them
	if (empty($company_id)) {
		$error_msg .= "company_id value should be included<br />";
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
	
	// Connect to the database
	require_once (dirname(__FILE__) . "/shared/connect.php");
	
	// Build a SQL string to select all the companies in the table company
	$sql = "SELECT * FROM company WHERE id = :company_id";
	
	// prepare the SQL statement
	$sth = $dbh->prepare($sql);
	
	// bind the parameters
	$sth->bindParam(":company_id", $company_id, PDO::PARAM_INT);
	
	// execute the artist SQL
	$sth->execute();
	
	// store the result
	$company = $sth->fetch();
	
	// if there is no data, it means access way has problem.
	if (!$company) {
		$_SESSION["fail"] = "Please access proper way by a provided link";
		header("Location: confirmed.php");
		exit;
	}
	
	// close the cursor so we can execute the next statement
	$sth->closeCursor();
	
	// employee SQL
	$sql = "SELECT * FROM employee WHERE company_id = :company_id";
	
	// prepare the SQL
	$sth = $dbh->prepare($sql);
	
	// fill the placehoders
	$sth->bindParam(":company_id", $company_id, PDO::PARAM_INT);
	
	// execute
	$sth->execute();
	
	// store the results
	$employees = $sth->fetchAll();
	
	// Close the connection
	$dbh = null;
?>
<html>
  <head>
	<link crossorigin='anonymous' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' integrity='sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7' rel='stylesheet'>
	<link crossorigin='anonymous' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css' integrity='sha384-aNUYGqSUL9wG/vP7+cWZ5QOM4gsQou3sBfWRr/8S3R1Lv0rysEmnwsRKMbhiQX/O' rel='stylesheet'>
	<link href="css/custom.css" rel="stylesheet">
	<title>Companies</title>
  </head>
  <!-- 
	CREATE TABLE company (
		id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
		company_name VARCHAR(70) NOT NULL,
		total_stock INT NOT NULL,
		net_capital DECIMAL(15,2) NOT NULL,
		date_of_establishment DATE NOT NULL
	); 
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
  -->
  <body>
	<div class="container-fluid">
		<nav class="navbar navbar-inverse navbar-custom">
			<div class="navbar-header">
				<a href="new_company.php" class="navbar-brand">COMPANIES</a>
			</div>
			<div>
			<ul class="nav navbar-nav navbar-right" style="margin-right: 20px;">
				<li><a href="new_company.php" title="Add new company here">Add Company</a></li>
				<li><a href="new_employee.php" title="Add new employee here">Add Employee</a></li>
				<li><a href="companies.php" title="View all company here">View Companies</a></li>
			</ul>
			</div>
		</nav>
	</div>
	<div class="container">
		<header>
			<h1 class="page-header">Company & Employees</h1>
		</header>
		<section>
			<h4 class="page-header">Company Name : <?= $company['company_name'] ?></h4>
			<h4 class="page-header">Total Stock : <?= $company['total_stock'] ?></h4>
			<h4 class="page-header">Net Capital ($) : <?= $company['net_capital'] ?></h4>
			<h4 class="page-header">Date of Establishment : <?= $company['date_of_establishment'] ?></h4>
			<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>No</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Date of Birth</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ( $employees as $index => $employee ): ?>
				<tr>
					<td><?= $index + 1 ?></td>
					<td><?= $employee['first_name'] ?></td>
					<td><?= $employee['last_name'] ?></td>
					<td><?= $employee['date_of_birth'] ?></td>
				</tr>
				<?php endforeach ?>
			</tbody>
			</table>
		</section>
	</div>
	
	<script crossorigin='anonymous' integrity='sha256-laXWtGydpwqJ8JA+X9x2miwmaiKhn8tVmOVEigRNtP4=' src='https://code.jquery.com/jquery-2.2.3.js'></script>
	<script crossorigin='anonymous' integrity='sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS' src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>
  </body>
</html>
