<?php
	// connect to DB
	$dbh = new PDO("mysql:host=us-cdbr-azure-southcentral-e.cloudapp.net;dbname=acsm_855816b26cc82d2", "bdd2a9f50ea66c", "aa83c352");
	$dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	// build the SQL
	$sql = "SELECT id, name FROM artists";
	
	// get results
	$artists = $dbh->query($sql);
	$row_count = $artists->rowCount();
	//$sth = $dbh->prepare($sql);
	//$sth->execute();
	//$artists = $sth->fetchAll();
	
	// close the connection
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
      	<h1 class="page-header">Add New Song</h1>
      </header>
      <section>
      	<?php if ( $row_count > 0): ?>
      	<form method="post" action="add_song.php">
      	<fieldset>
      		<legend>Song Information</legend>
      		<div class="form-group">
      			<label for="artists">Artist</label>
      			<select name="artist" class="form-control" required="required">
      			<option selected="selected">...select an artist...</option>
      			<?php foreach ( $artists as $artist): ?>
      				<option value="<?= $artist["id"] ?>"><?= $artist["name"] ?></option>
      			<?php endforeach;?>
      			</select>
      		</div>
      		<div class="form-group">
      			<label for="title">Song Title</label>
      			<input type="text" name="title" id="title" class="form-control" placeholder="We're Going to be friends" required="required" />	
      		</div>
      		
      		<div class="form-group">
      			<div class="form-inline">
      				<div class="input-group">
      					<label class="input-group-addon">hours</label>
      					<input type="number" name="length[hours]" class="form-control" maxlength="23" min="0" />
      				</div>
      				
      				<div class="input-group">
      					<label class="input-group-addon">minutes</label>
      					<input type="number" name="length[minutes]" class="form-control" maxlength="59" min="0" />
      				</div>
      				
					<div class="input-group">
      					<label class="input-group-addon">seconds</label>
      					<input type="number" name="length[seconds]" class="form-control" maxlength="59" min="0" />
      				</div>
      			</div>
      		</div>
      		
      		<div class="input-group">
      			<button class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;Add Song</button>
      		</div>
      	</fieldset>
      	</form>
      	<?php else: ?>
      		<div class="alert alert-warning">
      			Danger Will Robinson~~~ YOU HAVE NO ARTISTIS~~~
      		</div>
      	<?php endif; ?>
      </section>
    </div>
    
    <script src="https://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  </body>
  
</html>