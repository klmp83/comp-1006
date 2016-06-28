<?php

// connect database
require_once (dirname(__FILE__) . "/shared/connect.php");

// get parameter from user
$id = $_GET['id'];

// build sql for removing a company
$sql ="DELETE FROM company WHERE id= :id";

// prepare the SQL statement
$sth = $dbh->prepare($sql);

// fill the placehoders
$sth->bindParam(":id", $id, PDO::PARAM_INT);

// execute the SQL
$sth->execute();

// close database
$dbh=null;

// redirect url
header('Location:companies.php');
?>