<!DOCTYPE html>
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
				<li class="active"><a href="new_company.php" title="Add new company here">Add Company</a></li>
				<li><a href="new_employee.php" title="Add new employee here">Add Employee</a></li>
				<li><a href="companies.php" title="View all company here">View Companies</a></li>
			</ul>
			</div>
		</nav>
	</div>
	
	<div class="container">
		<h1 class="page-header">Add Company</h1>
		<form method="post" action="add_company.php">
			<fieldset>
				<legend>New Company Information</legend>
				<div class="form-group">
					<label>Company Name</label>
					<input type="text" name="company_name" class="form-control" placeholder="Input Company Name" required="required"/>
				</div>
				<div class="form-group">
					<label>Total Stock</label>
					<input type="number" name="total_stock" class="form-control" placeholder="Input Total Stock" required="required" />
				</div>
				<div class="form-group">
					<label>Net Capital ($)</label>
					<input type="text" name="net_capital" class="form-control" placeholder="Input Net Capital" required="required"/>
				</div>
				<div class="form-group">
					<label>Date of Establishment</label>
					<input type="date" name="date_of_establishment" class="form-control" placeholder="Input Date of Establishment" required="required"/>
				</div>
				<div class="form-group">
					<button type="submit" name="submit" class="btn btn-primary btn-large"><i class="fa fa-plus"></i>&nbsp;Add Company</button>
					<button type="reset" name="reset" class="btn btn-danger btn-large">Clear</button>
				</div>
			</fieldset>
		</form>
	</div>
	
	<script crossorigin='anonymous' integrity='sha256-laXWtGydpwqJ8JA+X9x2miwmaiKhn8tVmOVEigRNtP4=' src='https://code.jquery.com/jquery-2.2.3.js'></script>
	<script crossorigin='anonymous' integrity='sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS' src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>
  </body>
</html>
