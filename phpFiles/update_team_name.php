<?php
    session_start();

    $_SESSION['id']=$_GET['id'];
    if(isset($_SESSION['failed'])) {
        $failed = $_SESSION['failed'];
        $message = $_SESSION['message'];
    } else {
        $failed = false;
    }

    if(isset($_SESSION['validatedDone'])){
        $validatedDone = $_SESSION['validatedDone'];
    } else {
        $validatedDone = false;
    }
    
    
    require_once (dirname(__FILE__) . "/shared/connect.php");
    
    $team_id = $_GET["id"];
    
    // get artist
    $sql = "SELECT * FROM tblteams WHERE team_id = :team_id";
    
    // prepare the SQL statement
    $sth = $dbh->prepare($sql);
    $sth->bindParam(":team_id", $team_id, PDO::PARAM_INT);
    
    // execute the artist SQL
    $sth->execute();
    
    // store the result
    $team = $sth->fetch();
    
    $dbh = null;
?>

<!DOCTYPE html>
<html>
<head>
    <link crossorigin='anonymous' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' integrity='sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7' rel='stylesheet'>
    <link crossorigin='anonymous' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css' integrity='sha384-aNUYGqSUL9wG/vP7+cWZ5QOM4gsQou3sBfWRr/8S3R1Lv0rysEmnwsRKMbhiQX/O' rel='stylesheet'>
    <title>Hockey Team</title>
</head>
<body>
<div class="container-fluid">
    <nav class=" navbar navbar-inverse">
        <div class="navbar-header">
            <a href="new_team.php" class="navbar-brand">HOCKEY</a>
        </div>
        <div>
            <ul class="nav navbar-nav navbar-right" style="margin-right: 20px;">
                <li><a href="new_team.php" title="Add new team here">Add Team</a></li>
                <li class="active"><a href="new_player.php" title="Add new player here">Add player</a></li>
                <li><a href="teams.php" title="View all Team here">View Team</a></li>
            </ul>
        </div>
    </nav>
</div>

<div class="container">
   <header class="page-header">
       <h1>Update Team</h1>
   </header>
    <?php if($failed && $validatedDone) {?>
        <div class="alert alert-danger">
            <?=$message;?>
        </div>
    <?php   }?>
    <form method="post" action="update_team.php">
        <fieldset>
            <legend>Add New Information</legend>
            <div class="form-group">
                <label>Team Name</label>
                <input type="text" name="team_name" class="form-control" value="<?= $team["team_name"] ?>" placeholder="Input Team Name" required />
            </div>

            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-success btn-large"><i class="fa fa-plus"></i>&nbsp;Update Name</button>
                <button type="reset" name="reset" class="btn btn-danger btn-large">Clear</button>
            </div>
        </fieldset>
    </form>
</div>

<script crossorigin='anonymous' integrity='sha256-laXWtGydpwqJ8JA+X9x2miwmaiKhn8tVmOVEigRNtP4=' src='https://code.jquery.com/jquery-2.2.3.js'></script>
<script crossorigin='anonymous' integrity='sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS' src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>
</body>
</html>
