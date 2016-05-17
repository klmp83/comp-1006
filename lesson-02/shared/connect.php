<?php
	
	// localhosht or Dreamhost
	if( file_exists($_SERVER['DOCUMENT_ROOT'] . '/Lessons/lesson-02/shared/secret.php')) {
		require_once ($_SERVER['DOCUMENT_ROOT'] . '/Lessons/lesson-02/shared/secret.php');

		$host = $connection_details['host'];
		$dbname = $connection_details['database'];
		$username = $connection_details['username'];
		$password = $connection_details['password'];
		
	}
	
	// Azure
	if ( preg_match("/Azure/i", $_SERVER['HTTP_HOST'])) {
		// Database=acsm_855816b26cc82d2;Data Source=us-cdbr-azure-southcentral-e.cloudapp.net;User Id=bdd2a9f50ea66c;Password=aa83c352
		$conn_str = getenv("MYSQLCONNSTR_defaultConnection");
		$parts = explode(';', $conn_str);
		
		$url = [];
		foreach ( $parts as $part) {
			$temp = explode('=', $part);
			$url[$temp[0]] = $temp[1];
		}
			
		$host = $url["Data Source"];
		$dbname = $url["Database"];
		$username = $url["User Id"];
		$password = $url["aa83c352"];
		
		echo 'Azure';
	} else {
		echo 'things';
	}

	// connection to DB
	try {
		$dbh = new PDO("mysql:host={$host};dbname={$dbname}", $username, $password);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
		echo 'Connection failed: ' . $e->getMessage();
	}

?>