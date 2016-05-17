<!DOCTYPE html>
<?php 
if ( preg_match("/Azure/i", $_SERVER['HTTP_HOST'])) {
	echo 'Azure';
} else {
	echo 'Not Azure';
}
?>
<html>
  <head>
    <link crossorigin='anonymous' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' integrity='sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7' rel='stylesheet'>
    <link crossorigin='anonymous' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css' integrity='sha384-aNUYGqSUL9wG/vP7+cWZ5QOM4gsQou3sBfWRr/8S3R1Lv0rysEmnwsRKMbhiQX/O' rel='stylesheet'>
    <title>New Artist</title>
  </head>
  <body>
    <div class="container">
    	<h1 class="page-header">Add Artist</h1>
    	<form method="post" action="add_artist.php">
    		<fieldset>
    			<legend>Artist Information</legend>
    			<div class="form-group">
	    			<label>Artist Name</label>
	    			<input type="text" name="name" class="form-control" placeholder="White Stripes" required="required" />
	    		</div>
    			<div class="form-group">
	    			<label>Bio Link</label>
	    			<input type="text"  name="bio_link" class="form-control" placeholder="https://en.widipedia.org/wiki/The_White_Stripes" />
	    		</div>
	    		
	    		<div class="form-group">
	    			<button type="submit" class="btn btn-warning">
	    				<i class="fa fa-plus"></i>
	    				Add Artist
	    			</button>
	    		</div>
    		</fieldset>
    	</form>
    </div>
    
    <script crossorigin='anonymous' integrity='sha256-laXWtGydpwqJ8JA+X9x2miwmaiKhn8tVmOVEigRNtP4=' src='https://code.jquery.com/jquery-2.2.3.js'></script>
    <script crossorigin='anonymous' integrity='sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS' src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>
  </body>
</html>
