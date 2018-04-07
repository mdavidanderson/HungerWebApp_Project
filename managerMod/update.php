<?php 
	include('Includes/header.php');
	include('Includes/dbconnection.php');

	if($_SESSION['usertype_name'] != "owner" )
		header('Location: login.php');
?>
<html> 
	<head>
        <title>Hunger</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <style> 
            .navbar {
                margin-bottom: 0;
                border-radius: 0;
            }
            footer {
                background-color: #f2f2f2;
                padding: 25px;
            }
            .carousel-inner img {
                width: 100%; /* Set width to 100% */
                margin: auto;
                min-height:200px;
                max-height: 600px;
            }
            @media (max-width: 600px) {
                .carousel-caption {
                    display: none; 
                }
            }
        </style>
    </head>
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
						  " WHERE item_id=".$_SESSION['item_id'];

			$result=$conn->query($update_str);
			header('Location: owner.php');
			break;
		case "Create":
			$insert_str = "INSERT INTO item ".
						  "(menu_id, item_name, item_description, meat_id, spicy) ".
						  "VALUES (".$_SESSION['CurrentMenuID'].",'".$_POST['item_name']."', '".
						  $_POST['item_description']."', ".
						  $_POST['meat_name'].", ".
						  $_POST['spicy']. ")";
						 
			echo $result=$conn->query($insert_str);
			header('Location: owner.php');
			break;


		default:
			header('Location: Hompage.html');
			break;

	}
	?>
</body>
</html>