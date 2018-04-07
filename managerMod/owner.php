<?php
	include('Includes/header.php');
	include('Includes/dbconnection.php');

	if($_SESSION['usertype_name'] != "owner" )
		header('Location: home.php');
	else {
		$restqry = "SELECT r.restaurant_id, r.restaurant_name, l.street_address, l.zip_code, r.phone, r.rating ".
					"FROM restaurants r, location l, users u " . 
					"WHERE r.owner = ".$_SESSION['userID']." AND r.location_id=l.location_id";
		$rest_row = $conn->query($restqry)->fetch_assoc();
        $_SESSION['CurrentMenuID']=$rest_row['restaurant_id'];


		$menuitemsqry = "SELECT i.item_id, i.item_name, i.item_description, m.meat_name, i.spicy ".
						"FROM item i " .
						"INNER JOIN meats m ".
						"ON m.meat_id=i.meat_id ".
                        "WHERE i.menu_id = ".$rest_row['restaurant_id'];
		$item_result = $conn->query($menuitemsqry);
	}
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
		echo "<p>".$rest_row['restaurant_name']."</p>";
		echo "<p>".$rest_row['street_address']."</p>";
		echo "<p>".$rest_row['zip_code']."</p>";
		echo "<p>".$rest_row['phone']."</p>";
		echo "<br>";
        echo "<div><a href='create.php'>Create New Item</a></div>";
		echo"<div class='table-responsive'>";
		echo "<table class='table table-hover'>";
		echo "<thead>";
		echo "	<tr>";
		echo "		<th>Item Name</th>";
		echo "		<th>Description</th>";
		echo "		<th>Meat Type</th>";
		echo "		<th>Spicy</th>".
                    "<th></th>";
		echo "	</tr>";
		echo "</thead>" .
			 "<tbody>";

		while($item_row = $item_result->fetch_assoc() ) {
			echo "<tr>";
			echo "	<td>".$item_row['item_name']."</td>";
			echo "	<td>".$item_row['item_description']."</td>";
			echo "	<td>".$item_row['meat_name']."</td>";
			echo "	<td>";

            if($item_row['spicy']) 
                echo "Yes";
            else 
                echo "No";

            echo "  </td>";
            echo "  <td><a href='edit.php?itemID=".$item_row['item_id']."'>Edit/Delete</a></td>";
			echo "</tr>";
		}
		echo "</tbody>".
			 "</table>".
			 "</div>";

	?>
</body>
</html>
<?php
    include('Includes/footer.php');


?>