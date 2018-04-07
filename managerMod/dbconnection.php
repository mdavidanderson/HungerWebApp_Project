<?php
	$server_name="localhost";
	$user_name="mda";
	$user_pwd="";
	$db_name="HungerDB";
	$conn = mysqli_connect($server_name, $user_name, $user_pwd, $db_name);

	if(!$conn)
	{
		die("Connection failed: " . $conn->connection_error);
	}
?>
