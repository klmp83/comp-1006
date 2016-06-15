<?php
    session_start();
    $id=$_SESSION['id'];
    $name = $_POST['team_name'];
    $_SESSION['validatedDone']=true;

    require_once (dirname(__FILE__) . "/shared/connect.php");
    
	if(empty( $name )) {
	    $_SESSION['message']="Team name must be filled.<br>";
	    $_SESSION['failed']=true;
	    header('Location:update_team_name.php?id='.$id);
	    exit;
	} else {
	    $name = filter_var($name,FILTER_SANITIZE_STRING);
	}

    // 1. build the SQL statement
    $sql = "UPDATE tblteams SET team_name = :name WHERE team_id = :id";

	// 2. prepare the SQL statement
	$sth = $dbh->prepare($sql);

    $sth->bindParam(':name',$name,PDO::PARAM_STR);
    $sth->bindParam(':id',$id,PDO::PARAM_INT);

    // 4. execute the SQL
    $sth->execute();

    // 5. close the DB connection
    $dbh = null;

    header("Location: teams.php");
?>