<?php 
	session_start();
	include('Includes/dbconnection.php');

	if($_SESSION['usertype_name'] != "owner" )
		header('Location: login.php');
	
	switch ($_POST['button']) {
		case "No":
			$header_str="Location: edit.php?itemID=".$_SESSION["item_id"];
			header($header_str);
			break;
		case "Yes":
			$delete_str="DELETE FROM item WHERE item_id=".$_SESSION['item_id'];
			$result=$conn->query($delete_str);
			$_SESSION["item_id"]="";
			header('Location: owner.php');
			break;
		default:
			header('Location: login.php');
			break;
	}
?>