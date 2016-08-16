<?php 
	include_once __DIR__ . '/classes/class.user.php';
	$user = new User;
	
	/*
	$user->set_first_name("Junyeong");
	$user->set_last_name("Yu");
	$user->set_date_of_birth("1983-01-29");
	$user->set_gross_income(50000);
	*/
	
	$first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
	$last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
	$date_of_birth = isset($_POST['date_of_birth']) ? $_POST['date_of_birth'] : '';
	$gross_income = isset($_POST['gross_income']) ? $_POST['gross_income'] : '';
	
	$user->set_first_name($first_name);
	$user->set_last_name($last_name);
	$user->set_date_of_birth($date_of_birth);
	$user->set_gross_income($gross_income);
	
	$userFields = $user->object_to_array();
	
	/* Self-Check
O	(5 pts)    An intuitive class name is used
O	(5 pts)    The class is properly defined
O	(10 pts)  All properties and methods are intuitively named
O	(10 pts)  All properties and methods are properly defined
O	(10 pts)  All properties and methods are properly scoped (public, private)
O	(25 pts)  Getters and setters have been defined for all properties
O	(10 pts)  The user's age is correctly calculated
O	(10 pts)  The user's net income is correctly calculated
O	(5 pts)    A properly setup HTML page is used to output the user's information (use may use the GitHub template)
O	(20 pts)  The returned user information is either an object or associative array
O	(20 pts)  The data is legible and in a styled organized layout
	(10 pts)  You've submitted a working URL and the file -> Top of class file
	*/
?>
<!DOCTYPE HTML>
<html lang="en">

  <head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-aNUYGqSUL9wG/vP7+cWZ5QOM4gsQou3sBfWRr/8S3R1Lv0rysEmnwsRKMbhiQX/O" crossorigin="anonymous">
    <title>title</title>
  </head>

  <body>
	<div class="container-fluid">
		<nav class="navbar navbar-inverse" style="background-color: #444;">
			<div class="navbar-header">
				<a href="#" class="navbar-brand">User</a>
			</div>
		</nav>
	</div>
    <!-- This is a Bootstrap container. Get more info at http://getbootstrap.com/ -->
    <div class="container">
	
		<form action="index.php" method="post">
		  
		  <fieldset>
		    <legend>User Information</legend>
		
		    <div class="form-group">
		      <label for="first_name">First Name</label>
		      <input class="form-control" type="text" name="first_name" maxlength="100" required="required" value="Junyeong" />
		    </div>
		
		    <div class="form-group">
		      <label for="last_name">Last Name</label>
		      <input class="form-control" type="text" name="last_name" maxlength="100" required="required" value="Yu" />
		    </div>
		
		    <div class="form-group">
		      <label for="date_of_birth">Date of Birth</label>
		      <input class="form-control" type="date" name="date_of_birth" required="required" value="1983-01-29" />
		    </div>
		    
		    <div class="form-group">
		      <label for="price">Gross Income</label>
		      <input class="form-control" type="text" name="gross_income" min="0.01" step="any" required="required" value="5000" />
		    </div>
			<div class="form-group">
				<button type="submit" class="btn btn-danger"><i class="fa fa-pencil">&nbsp;</i>Calcute User</button>
			</div>		  
		  </fieldset>
		</form>
		<?php if(isset($_POST['first_name'])) : ?>
		<table class="table table-striped table-condensed table-hover">
			<thead>
				<tr>
					<th>Full Name</th>
					<th>Age</th>
					<th>Gross Income</th>
					<th>Net Income</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<?php foreach ( $userFields as $key => $value ): ?>
						<td><?= $value ?></td>
					<?php endforeach; ?>
				</tr>
			</tbody>
		</table>
		<?php endif; ?>
    </div>
    <script src="https://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  </body>
  
</html>