<!DOCTYPE html>
<?php
	// Connect to the database
	require_once (dirname(__FILE__) . "/shared/connect.php");
	
	// Build a SQL string to select all the companies in the table company
	$sql = "SELECT *, (SELECT COUNT(*) FROM employee WHERE company_id=company.id) AS number_of_employees FROM company";
	
	// Fetch the results
	$companies = $dbh->query($sql);
	$row_count = $companies->rowCount();
	
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
				<li class="active"><a href="companies.php" title="View all company here">View Companies</a></li>
			</ul>
			</div>
		</nav>
	</div>
	
	<div class="container">
		<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th>No</th>
				<th>Company Name</th>
				<th>Total Stock</th>
				<th>Net Capital ($)</th>
				<th class="center">Date of Establishment</th>
				<th class="center">Number of Employees</th>
				<th class="center">Remove</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ( $companies as $index => $company ): ?>
			<tr>
				<td><?= $index + 1 ?></td>
				<td><a href="company_employees.php?company_id=<?= $company['id'] ?>"><?= $company['company_name'] ?></a></td>
				<td><?= $company['total_stock'] ?></td>
				<td><?= $company['net_capital'] ?></td>
				<td class="center"><?= $company['date_of_establishment'] ?></td>
				<td class="center"><a href="company_employees.php?company_id=<?= $company['id'] ?>"><?= $company['number_of_employees'] ?></a></td>
				<td class="center">
					<a href="remove_company.php?id=<?= $company['id'] ?>"><i class="fa fa-pencil"></i></a>
				</td>
			</tr>
			<?php endforeach ?>
		</tbody>
		</table>
	</div>
	
	<script crossorigin='anonymous' integrity='sha256-laXWtGydpwqJ8JA+X9x2miwmaiKhn8tVmOVEigRNtP4=' src='https://code.jquery.com/jquery-2.2.3.js'></script>
	<script crossorigin='anonymous' integrity='sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS' src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>
  </body>
</html>
