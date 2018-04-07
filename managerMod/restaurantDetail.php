<?php
	function restaurantDetail($username, $conn) {
		echo "<p>Restaurant Details</p>";
		$sql_select = "SELECT username FROM users";
		echo "<p>SUCCESS</p>";
		$result=$conn->query($sql_select);
		echo "<p>SUCCESS</p>";
		//while($row = $result->fetch_assoc()) {
		//	echo $row['username'].$row['password'];
		//}
	}
?>