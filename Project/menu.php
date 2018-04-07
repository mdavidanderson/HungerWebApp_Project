<?php
    include('Includes/header.php');
    include('includes/dbconnection.php');

	if($_SESSION['usertype_name'] != "customer" )
		header('Location: logout.php');
?>
<html>

    <body>
        <?php
            $select_menu = "SELECT * FROM item";
            $result = $conn->query($select_menu);

            if($result->num_rows > 0){
                echo "<div class='table-responsive'>
                        <table class='table table-bordered'>
                            <tr>
                                <th width='30%'>Item</th>
                                <th width='40%'>Description</th>
                                <th width='10%'>Spicy</th>
                                <th width='20%'>Price</th>
                            </tr>";
                while($row = $result->fetch_assoc()){
                    echo
                        "<tr>" .
                                "<td>".$row['item_name']."</td>".
                                "<td>".$row['item_description']."</td>";
                                if($row['spicy'] == 1)
                                    $spicy = "Yes"; 
                                else 
                                    $spicy = "No";                                
                    echo        "<td>".$spicy."</td>".
                                "<td>".$row['price']."</td>".
                        "</tr>";
                }
                echo "</table>
                </div>";
            }
            else {
                echo "<h3>Sorry try again later!</h3>";
            }
            include('Includes\footer.php')
        ?>
    </body>
</html>