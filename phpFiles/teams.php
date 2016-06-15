<?php

	require_once (dirname(__FILE__) . "/shared/connect.php");

    $sql ='SELECT * FROM tblteams';

    $sth=$dbh->prepare($sql);

    $sth->execute();

    $teams=$sth->fetchAll();
    $row_count = $sth->rowCount();
    $dbh=null;
?>

<!DOCTYPE HTML>
<html lang="en">

    <head>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-aNUYGqSUL9wG/vP7+cWZ5QOM4gsQou3sBfWRr/8S3R1Lv0rysEmnwsRKMbhiQX/O" crossorigin="anonymous">
        <title>Hockey Teams</title>
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
                    <li ><a href="new_player.php" title="Add new Player here">Add player</a></li>
                    <li class="active"><a href="teams.php" title="View all Team here">View Team</a></li>
                </ul>
            </div>
        </nav>
    </div>
      <div class="container">
        <header>
          <h1 class="page-header">All Teams</h1>
        </header>
        <section>
          <?php if ($row_count > 0 ): ?>
            <table class="table table-striped">
              <thead>
                <tr>
                  <td><strong>No</strong></td>
                  <td><strong>Team Name</strong></td>
                </tr>
              </thead>
              <tbody>
                <?php $i =1;?>
                <?php foreach ($teams as $team): ?>
                  <tr>
                      <td><?=$i;$i++;?></td>
                    <td><strong><a href="players.php?id=<?=$team['team_id']?>" > <?= htmlspecialchars($team['team_name']) ?></a></strong></td>
                      <td><a href="update_team_name.php?id=<?= $team['team_id']?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                              Update</a></td>
                      <td><a href="delete_team.php?id=<?= $team['team_id']?>"><i class="fa fa-trash-o" aria-hidden="true"></i>
                              Delete</a></td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          <?php else: ?>
            <div class="alert alert-warning">
              No team information to display
            </div>
          <?php endif ?>
        </section>
      </div>

      <script src="https://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    </body>

  </html>
