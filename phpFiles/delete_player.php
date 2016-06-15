<?php

require_once (dirname(__FILE__) . "/shared/connect.php");
	
$id=$_GET['id'];

$sql ="DELETE FROM tblplayers WHERE player_Id= $id";

$sth=$dbh->prepare($sql);

$sth->execute();

$dbh=null;

header('Location:teams.php');
?>