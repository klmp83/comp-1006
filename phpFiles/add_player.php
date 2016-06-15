<?php
    session_start();
	require_once (dirname(__FILE__) . "/shared/connect.php");
    
        $team_id =  $_POST['id'];
        $player_name = $_POST['player_name'];

        $_SESSION['failed_player']=false;
        $_SESSION['failed_message_player']="";

        if($team_id == 0) {
            $_SESSION['failed_message_player'].="Team Must be selected.<br>";
            $_SESSION['failed_player']=true;
        } else {
            $team_id = filter_var($team_id,FILTER_SANITIZE_NUMBER_INT);
        }
        if(empty( $player_name )) {
            $_SESSION['failed_message_player'].="Player name must be selected.<br>";
            $_SESSION['failed_player']=true;
        } else {
            $player_name = filter_var($player_name,FILTER_SANITIZE_STRING);
        }

        if($_SESSION['failed_player']) {
            header('Location:new_player.php');
            exit;
        }

    $sql ='INSERT INTO tblplayers (player_name,team_id) VALUE (:player_name,:team_id)';

    $sth=$dbh->prepare($sql);

    $sth->bindParam(':player_name',$player_name,PDO::PARAM_STR,50);
    $sth->bindParam(':team_id',$team_id,PDO::PARAM_INT,11);

    $sth->execute();

    $dbh=null;

    header('Location:players.php?id='.$team_id);
    exit;

?>