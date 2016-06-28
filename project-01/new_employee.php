<!DOCTYPE html>
<?php
	// Connect to the database
	require_once (dirname(__FILE__) . "/shared/connect.php");
	
	// Build a SQL string to select all the companies in the table company
	$sql = "SELECT id, company_name FROM company";
	
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
				<li class="active"><a href="new_employee.php" title="Add new employee here">Add Employee</a></li>
				<li><a href="companies.php" title="View all company here">View Companies</a></li>
			</ul>
			</div>
		</nav>
	</div>
	
	<div class="container">
		<h1 class="page-header">Add Employee</h1>
		<form method="post" action="add_employee.php">
			<fieldset>
				<legend>New Employee Information</legend>
				<div class="form-group">
					<label>First Name</label>
					<input type="text" name="first_name" class="form-control" placeholder="Input First Name" required="required"/>
				</div>
				<div class="form-group">
					<label>Last Name</label>
					<input type="text" name="last_name" class="form-control" placeholder="Input Last Name" required="required"/>
				</div>
				<div class="form-group">
					<label>Date of Birth</label>
					<input type="date" name="date_of_birth" class="form-control" placeholder="Input Date of Birth" required="required"/>
				</div>
				<div class="form-group">
					<select name="company_id" class="form-control">
						<option value="">--- Select a Company ---</option>
						<?php foreach ($companies as $company): ?>
					 	<option value="<?= $company["id"]?>"><?= $company["company_name"]?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="form-group">
					<button type="submit" name="submit" class="btn btn-primary btn-large"><i class="fa fa-plus"></i>&nbsp;Add Employee</button>
					<button type="reset" name="reset" class="btn btn-danger btn-large">Clear</button>
				</div>
			</fieldset>
		</form>
	</div>
	
	<script crossorigin='anonymous' integrity='sha256-laXWtGydpwqJ8JA+X9x2miwmaiKhn8tVmOVEigRNtP4=' src='https://code.jquery.com/jquery-2.2.3.js'></script>
	<script crossorigin='anonymous' integrity='sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS' src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>
  </body>
</html>
