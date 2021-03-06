<?php
	// connect to database
	$dbh = new PDO("mysql:host=us-cdbr-azure-southcentral-e.cloudapp.net;dbname=acsm_855816b26cc82d2",
			"bdd2a9f50ea66c", "aa83c352");
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	// build the SQL statement
	$sql = "SELECT * FROM artists";
	
	// prepare our SQL
	// $artists = $dbh->query($sql);
	$sth = $dbh->prepare($sql);
	$sth->execute();
	$artists = $sth->fetchAll();
	$row_count = $sth->rowCount();
	
	// close the DB connection
	$dbh = null;
	
	//echo '<pre>', var_dump($artists), '</pre>';
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
      	<h1 class="page-header">All Artists</h1>
      </header>
      
      <section>
      	<?php if ( $row_count > 0): ?>
      		<table class="table">
      			<thead>
      				<tr>
      					<td>Name</td>
      					<td>Bio</td>
      				</tr>
      			</thead>
      			<tbody>
      				<?php foreach ($artists as $artist): ?>
      				<tr>
      					<td><a href="artist_songs.php?artist_id=<?= $artist["id"]; ?>"><?= $artist["name"]; ?></a></td>
      					<td><a href="<?= $artist["bio_link"]; ?>" title="<?= $artist["name"]; ?>"><?= $artist["bio_link"]; ?></a></td>
      				</tr>
      				<?php endforeach; ?>
      			</tbody>
      		</table>
      	<?php else: ?>
      		<div class="alert alert-warning">No artists information to display.</div>
      	<?php endif; ?>
      </section>
    </div>
    
    <script src="https://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  </body>
  
</html>