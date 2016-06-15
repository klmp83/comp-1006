<?php
	session_start();
	require_once (dirname(__FILE__) . "/shared/connect.php");
		
		// 1. build the SQL statement
		$sql = "INSERT INTO tblteams (team_name) VALUES (:team_name)";

		// assign our values to variables
		$team_name = $_POST["team_name"];
		if(empty($team_name)) {
			$_SESSION['failed']=true;
			$_SESSION['failed_message'] = "Team Name must be given";
			header('Location:new_team.php');
			exit;

		} else {
			$_SESSION['failed']=false;
			$team_name = filter_var($team_name,FILTER_SANITIZE_STRING);
		}

		// 2. prepare the SQL statement
		$sth = $dbh->prepare($sql);
		
		// 3. fill the placehoders
		$sth->bindParam(":team_name", $team_name, PDO::PARAM_STR, 50);

		// 4. execute the SQL
		$sth->execute();
		
		// 5. close the DB connection
		$dbh = null;

		$_SESSION["message"] = "Team was added successfully.<br />";
		header("Location: teams.php");

?>