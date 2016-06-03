<?php

	// get our connection script
	if ( preg_match("/Azure/i", $_SERVER['HTTP_HOST'])) {
		require_once ($_SERVER['DOCUMENT_ROOT'] . '/lesson-02/shared/connect.php');
	} else {
		require_once ($_SERVER['DOCUMENT_ROOT'] . '/Lessons/lesson-02/shared/connect.php');
	}
	
	// build the SQL statement
	$sql = 'INSERT INTO artists (name, bio_link) VALUES (:name, :bio_link)';
	
	// assign our values to variables
	$name = $_POST['name'];
	$bio_link = $_POST['bio_link'];
	
	// prepare the SQL statement
	$sth = $dbh->prepare($sql);
	
	// fill the placehoders
	$sth->bindParam(':name', $name, PDO::PARAM_STR, 50);
	$sth->bindParam(":bio_link", $bio_link, PDO::PARAM_STR, 100);
	
	// execute the SQL
	$sth->execute();
	
	// close the DB connection
	$dbh = null;

?>