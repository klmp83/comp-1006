<?php

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

?>