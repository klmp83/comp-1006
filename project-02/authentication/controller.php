<?php

  session_start();

  require_once __DIR__ . '/../config.php';
  
  /* Views */
  function login () {
  	return get_included_file_contents('views/login.php');
  }
  
  /* Processes */
  function authenticate ( $post ) {
  	$user = User::find('first', ['email' => $post['email']]);
  	if ($user && password_verify($post['password'], $user->password)) {
  		$_SESSION['authenticated'] = true;
  		$_SESSION['id'] = $user->id;
  		$_SESSION['role'] = $user->role;
  		$_SESSION['email'] = $user->email;
  		$_SESSION['success'] = 'You have successfully logged in.';
  		header( 'location: ../genres/index.php?action=index');
  		exit;
  	} else {
  		$_SESSION['fail'] = 'You could not be logged in at this time.';
  		header( 'Location: index.php?actioin=login');
  		exit;
  	}
  }
  
  function logout () {
  	if ( isset($_SESSION['authenticated'])) {
  		unset($_SESSION['authenticated']);
  		unset($_SESSION['id']);
  		unset($_SESSION['email']);
  		unset($_SESSION['role']);
  		$_SESSION['success'] = 'You have been successfully logged out.';
  		header( 'location: index.php?action=login');
  		exit;
  	}
  }
  
  /* Authentication Block */
  request_is_authenticated($_REQUEST, ['login', 'authenticate']); // allowed functions
  
  // action handler for REQUEST
  $yield = action_handler( ['login', 'authenticate', 'logout'], $_REQUEST );

