<?php
    include('Includes/header.php');
    include('Includes/dbconnection.php');

    if(!isset($_SESSION["userID"] )){
        header('Location: logout.php');
    }

?>
<html>

    <body>
        <?php
            $select_menu = "SELECT * FROM item";
            $result = $conn->query($select_menu);
            $itemArray = array();

            if($result->num_rows > 0){
                echo "<div class='table-responsive'>";
                echo "<table class='table table-hover'>";
                echo "<tr><th>Item</th><th>Description</th><th>Price</th></tr>";
                while($row = $result->fetch_assoc()){

                    array_push($itemArray, $row['item_name']);

                    echo
                        "<tr>" .
                                "<td>".$row['item_name']."</td>".
                                "<td>".$row['item_description']."</td>".
                                "<td>".$row['price']."</td>".
                                "<td><input type='number' name=".$row['item_id']." value='0'></td>" .
                        "</tr>";
                }
                    echo "</table>" .
                        "<button type='submit'>ORDER</button>";
                echo "</div>";

            }
            else {
                echo "<h3>Sorry try again later!</h3>";
            }

        ?>
    </body>
</html>