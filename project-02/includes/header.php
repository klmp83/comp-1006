<?php

  if ( session_status() == PHP_SESSION_NONE ) session_start();

  $messages = [
	'success' => isset( $_SESSION['success'] ) ? $_SESSION['success'] : null,
	'fail' => isset( $_SESSION['fail'] ) ? $_SESSION['fail'] : null
  ];

  unset( $_SESSION['success'] );
  unset( $_SESSION['fail'] );

  $whatINeed = explode('/', $_SERVER['REQUEST_URI']);
  $whatINeed = $whatINeed[1];
  echo $whatINeed;
?>

<!DOCTYPE HTML>
<html lang="en">

  <head>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-aNUYGqSUL9wG/vP7+cWZ5QOM4gsQou3sBfWRr/8S3R1Lv0rysEmnwsRKMbhiQX/O" crossorigin="anonymous">
	<link href="/Lessons/project-02/css/custom.css" rel="stylesheet">
	<title><?= isset( $page_title ) ? $page_title : 'COMP-1006' ?></title>
  </head>

  <body>
	<?php require_once __DIR__ . '/notify.php' ?>
	<div class="container-fluid">
		<nav class="navbar navbar-inverse navbar-custom">
			<div class="navbar-header">
				<a href="/Lessons/project-02/genres/index.php?action=index" class="navbar-brand">My Books</a>
			</div>
			<div>
			<ul class="nav navbar-nav navbar-right" style="margin-right: 20px;">
			<?php if ( is_authenticated()): ?>
				<li><a href="/Lessons/project-02/genres/index.php?action=index">Genres</a></li>
				<li><a href="/Lessons/project-02/genres/index.php?action=create">New Genre</a></li>
				<li><a href="/Lessons/project-02/books/index.php?action=create">New Book</a></li>
				<li><a href="/Lessons/project-02/users/index.php?action=index">Users</a></li>
				<li><a href="/Lessons/project-02/authentication/index.php?action=logout"><i class="fa fa-sign-out">&nbsp;</i>Sign Out</a></li>
			<?php else: ?>
				<li><a href="/Lessons/project-02/authentication/index.php?action=login"><i class="fa fa-sign-in">&nbsp;</i>Sign In</a></li>
				<li><a href="/Lessons/project-02/users/index.php?action=create">New User</a></li>
			<?php endif ?>
			</ul>
			</div>
		</nav>
	</div>