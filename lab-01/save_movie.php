<?php
	/* 
		CREATE TABLE movies(
			id				INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
			movieTitle  	VARCHAR(50) NOT NULL,
			directorName	VARCHAR(40) NOT NULL,
			genreName		VARCHAR(30) NOT NULL,
			runningTime		TIME NOT NULL,
			regDate			DATETIME NOT NULL
		);
	 */
	
	// get our connection script
	if ( preg_match("/Azure/i", $_SERVER['HTTP_HOST'])) {
		require_once ($_SERVER['DOCUMENT_ROOT'] . '/lab-01/shared/connect.php');
	} else {
		require_once ($_SERVER['DOCUMENT_ROOT'] . '/Lessons/lab-01/shared/connect.php');
	}
	
	// build the SQL statement
	$sql = "INSERT INTO movies (movieTitle, directorName, genreName, runningTime, regDate) VALUES (:movieTitle, :directorName, :genreName, :runningTime, NOW())";
	
	// assign our values to variables
	$movieTitle = $_POST["movieTitle"];
	$directorName = $_POST["directorName"];
	$genreName = $_POST["genreName"];
	$runningTimeArray = $_POST["runningTime"];
	$runningTime = $runningTimeArray["hours"] . ":" . $runningTimeArray["minutes"] . ":" . $runningTimeArray["seconds"]; 
	
	// prepare the SQL statement
	$sth = $dbh->prepare($sql);
	
	// fill the placehoders
	$sth->bindParam(":movieTitle", $movieTitle, PDO::PARAM_STR, 50);
	$sth->bindParam(":directorName", $directorName, PDO::PARAM_STR, 40);
	$sth->bindParam(":genreName", $genreName, PDO::PARAM_STR, 30);
	$sth->bindParam(":runningTime", $runningTime, PDO::PARAM_STR);
	
	// execute the SQL
	$sth->execute();
	
	// close the DB connection
	$dbh = null;

?>