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


		$menuitemsqry = "SELECT i.item_id, i.item_name, i.item_description, m.meat_name, i.spicy, i.price ".
						"FROM item i " .
						"INNER JOIN meats m ".
						"ON m.meat_id=i.meat_id ".
                        "WHERE i.menu_id = ".$rest_row['restaurant_id'];
		$item_result = $conn->query($menuitemsqry);

		$countqry = "SELECT COUNT(*) as 'itemCount' FROM item";
		$count = $conn->query($countqry)->fetch_assoc();
	}
?>


    <body>

	<?php
		echo "<p>".$rest_row['restaurant_name']."</p>";
		echo "<p>".$rest_row['street_address']."</p>";
		echo "<p>".$rest_row['zip_code']."</p>";
		echo "<p>".$rest_row['phone']."</p>";
		echo "<p>Total Items in Menu: ".$count['itemCount']."</p>";
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
					"<th>Price</th>".
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
            echo "	<td>".$item_row['price']."</td>";
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