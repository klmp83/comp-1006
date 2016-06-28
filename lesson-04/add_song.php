<?php
	
	/* Validating And Sanitizing The Data Before We Input It Into The Database */
	
	// setting a flag variable to distinguish if ther values are validated
	$validation = true;
	
	// variable to store our error message
	$error_msg = "";
	
	// check that song title isn't empty
	if (empty($_POST["title"])) {
		$error_msg .= "You must enter a song title<br />";
		$validation = false;
	} else {
		$_POST['title'] = filter_var($_POST, FILTER_SANITIZE_STRING);
	}
	
	// check that the artist id isn't empty is valid integer
	if (empty($_POST["artist"]) || filter_var($_POST["artist"], FILTER_VALIDATE_INT) == false) {
		$error_msg = "You must select an artist<br />";
		$validation = false;
	}
	
	// initiate the session so we can pass some information between pages
	session_start();
	
	if ($validation == true) {
		// connect to database
		$dbh = new PDO("mysql:host=us-cdbr-azure-southcentral-e.cloudapp.net;dbname=acsm_855816b26cc82d2",
				"bdd2a9f50ea66c", "aa83c352");
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		// build the SQL statement
		$sql = 'INSERT INTO songs (artist_id, title, length) VALUES (:artist_id, :title, :length)';
		
		// assign our values to variables
		$artist_id = $_POST["artist"];
		$title = $_POST["title"];
		$lengthArray = $_POST["length"];
		
		// create a time stamp
		$length = $lengthArray["hours"] * 3600 + $lengthArray["minutes"] + 60 + $lengthArray["seconds"];
		
		// prepare the SQL statement
		$sth = $dbh->prepare($sql);
		
		// fill the placehoders
		$sth->bindParam(':artist_id', $artist_id, PDO::PARAM_INT, 50);
		$sth->bindParam(":title", $title, PDO::PARAM_STR, 100);
		$sth->bindParam(":length", $length, PDO::PARAM_STR);
		
		// execute the SQL
		$sth->execute();
		
		// close the DB connection
		$dbh = null;
		
		$_SESSION["message"] = "Song was successfully added";
		header("Location: artist_songs.php?artist_id=" . $artist_id);
	} else {
		$_SESSION["message"] = $error_msg;
		header("Location: new_song.php");
	}
?>