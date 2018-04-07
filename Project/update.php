<?php 
	include('Includes/header.php');
	include('Includes/dbconnection.php');

	if($_SESSION['usertype_name'] != "owner" )
		header('Location: login.php');
?>

    <body>

    <?php
	switch ($_POST['button']) {
		case "Cancel":
			header('Location: owner.php');
			break;
		case "Delete":
			echo "<form method='post' action='delete.php'>".
					"<label>Are you sure you want to delete this record?</label>".
					"<input type='submit' name='button' value='Yes'>".
					"<input type='submit' name='button' value='No'>".
					"</form>";
			break;
		case "Update":
			$update_str = "UPDATE item ".
						  "SET item_name='".$_POST['item_name'].
						  "', item_description='".$_POST['item_description'].
						  "', meat_id=".$_POST['meat_name'].
						  ", spicy=".$_POST['spicy'].
						  ", price=".$_POST['price'].
						  " WHERE item_id=".$_SESSION['item_id'];

			$result=$conn->query($update_str);
			header('Location: owner.php');
			break;
		case "Create":
			$insert_str = "INSERT INTO item ".
						  "(menu_id, item_name, item_description, meat_id, spicy, price) ".
						  "VALUES (".$_SESSION['CurrentMenuID'].",'".$_POST['item_name']."', '".
						  $_POST['item_description']."', ".
						  $_POST['meat_name'].", ".
						  $_POST['spicy']. ", ".
						  $_POST['price'].")";
						 
			echo $result=$conn->query($insert_str);
			header('Location: owner.php');
			break;


		default:
			header('Location: home.php');
			break;

	}
	?>
</body>
</html>

<?php
    include('Includes/footer.php');


?>