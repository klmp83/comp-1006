<?php 
echo dirname(__FILE__) . "<br />";
echo $_SERVER['DOCUMENT_ROOT'] . "<br />";
echo dirname("/etc/") . "<br />";
?>
<!DOCTYPE HTML>
<html lang="en">

  <head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-aNUYGqSUL9wG/vP7+cWZ5QOM4gsQou3sBfWRr/8S3R1Lv0rysEmnwsRKMbhiQX/O" crossorigin="anonymous">
    <title>Movie Registration</title> 
  </head>

  <body>
    <!-- This is a Bootstrap container. Get more info at http://getbootstrap.com/ -->
    <div class="container">
      <header>
      	<h1 class="page-header">Add New Movie</h1>
      </header>
      <section>
      	<form method="post" action="save_movie.php">
      	<fieldset>
      		<legend>Movie Information</legend>
      		<div class="form-group">
      			<label for="movieTitle">Movie Title</label>
      			<input type="text" name="movieTitle" id="movieTitle" class="form-control" placeholder="Movie Title" required="required" />
      		</div>
      		<div class="form-group">
      			<label for="directorName">Director Name</label>
      			<input type="text" name="directorName" id="directorName" class="form-control" placeholder="Director Name" required="required" />	
      		</div>
      		
      		<div class="form-group">
      			<label for="genreName">Genre Name</label>
      			<input type="text" name="genreName" id="genreName" class="form-control" placeholder="Genre Name" required="required" />	
      		</div>
      		
      		<div class="form-group">
      			<label for="runningTime">Running Time</label>
      			<div class="form-inline">
      				<div class="input-group">
      					<label class="input-group-addon">hours</label>
      					<input type="number" name="runningTime[hours]" class="form-control" maxlength="23" min="0" />
      				</div>
      				
      				<div class="input-group">
      					<label class="input-group-addon">minutes</label>
      					<input type="number" name="runningTime[minutes]" class="form-control" maxlength="59" min="0" />
      				</div>
      				
					<div class="input-group">
      					<label class="input-group-addon">seconds</label>
      					<input type="number" name="runningTime[seconds]" class="form-control" maxlength="59" min="0" />
      				</div>
      			</div>
      		</div>
      		
      		<div class="input-group">
      			<button class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;Add Movie</button>
      		</div>
      	</fieldset>
      	</form>
      </section>
    </div>
    
    <script src="https://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  </body>
  
</html>