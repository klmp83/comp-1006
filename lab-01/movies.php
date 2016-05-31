<?php
	// get our connection script
	if (preg_match("/Azure/i", $_SERVER['HTTP_HOST'])) {
		require_once ($_SERVER['DOCUMENT_ROOT'] . '/lab-01/shared/connect.php');
	} else {
		require_once ($_SERVER['DOCUMENT_ROOT'] . '/Lessons/lab-01/shared/connect.php');
	}
	
	// build the SQL statement
	$sql = "SELECT * FROM movies";
	
	// prepare our SQL
	// $artists = $dbh->query($sql);
	$sth = $dbh->prepare($sql);
	$sth->execute();
	$movies = $sth->fetchAll();
	$row_count = $sth->rowCount();
	
	// close the DB connection
	$dbh = null; 
	
?>
<!DOCTYPE HTML>
<html lang="en">

  <head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-aNUYGqSUL9wG/vP7+cWZ5QOM4gsQou3sBfWRr/8S3R1Lv0rysEmnwsRKMbhiQX/O" crossorigin="anonymous">
    <title>title</title>
  </head>

  <body>
    <!-- This is a Bootstrap container. Get more info at http://getbootstrap.com/ -->
    <div class="container">
      <header>
      	<h1 class="page-header">All Movies</h1>
      </header>
      
      <section>
      	<?php if ( $row_count > 0): ?>
      		<table class="table">
      			<thead>
      				<tr>
      					<td>Movie Title</td>
      					<td>Director</td>
      					<td>Genre</td>
      					<td>Running Time</td>
      				</tr>
      			</thead>
      			<tbody>
      				<?php foreach ($movies as $movie): ?>
      				<tr>
      					<td><?= $movie["movieTitle"]; ?></td>
      					<td><?= $movie["directorName"]; ?></td>
      					<td><?= $movie["genreName"]; ?></td>
      					<td><?= $movie["runningTime"]; ?></td>
      				</tr>
      				<?php endforeach; ?>
      			</tbody>
      		</table>
      	<?php else: ?>
      		<div class="alert alert-warning">No Movies information to display.</div>
      	<?php endif; ?>
      </section>
    </div>
    
    <script src="https://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  </body>
  
</html>