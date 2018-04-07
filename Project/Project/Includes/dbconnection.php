<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "hungerDB";

	$conn = mysqli_connect($servername, $username, $password, $dbname);

	if(!$conn) {
		die("Connection failed: " . $conn->connection_error);
	}

?>