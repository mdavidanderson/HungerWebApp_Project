<?php
    include('Includes/header.php');
    include('Includes/dbconnection.php');
    
	if($_SESSION['usertype_name'] != "customer" )
		header('Location: logout.php');

    if(isset($_POST['add_to_cart'])){
        if(isset($_SESSION['cart'])){
            $item_array_id = array_column($_SESSION['cart'], 'item_id');
            if(!in_array($_GET['id'], $item_array_id)){
                $count = count($_SESSION['cart']);
                $item_array = array(
                'item_id'               =>     $_GET['id'],  
                'item_name'               =>     $_POST['hidden_name'],  
                'price'          =>     $_POST['hidden_price'],  
                'item_quantity'          =>     $_POST['quantity']
                );
                $_SESSION['cart'][$count] = $item_array;

            }

        }
        else
        {  
           $item_array = array(  
                'item_id'               =>     $_GET['id'], 
                'item_name'               =>     $_POST['hidden_name'],                    
                'price'          =>     $_POST['hidden_price'],  
                'item_quantity'          =>     $_POST['quantity']  
           );  
           $_SESSION['cart'][0] = $item_array;  
      }
    }
    if(isset($_GET['action'])){  
        if($_GET['action'] == "delete"){  
            foreach($_SESSION['cart'] as $keys => $values){  
                if($values['item_id'] == $_GET['id']){  
                    unset($_SESSION['cart'][$keys]);  
                    echo '<script>alert("Item Removed")</script>  
                          <script>window.location="order.php"</script>';  
                }  
            }  
        }  
    }
?>
<html>

    <body>
        <?php
            $select_menu = "SELECT * FROM item ORDER BY item_id ASC";
            $result = $conn->query($select_menu);

            if($result->num_rows > 0){
                echo "<div class='table-responsive'>
                            <table class='table table-bordered'>
                                <tr>
                                    <th width='20%'>Item</th>
                                    <th width='40%'>Description</th>
                                    <th width='10%'>Spicy</th>
                                    <th width='15%'>Price</th>
                                    <th width='10%'>Quantity</th>
                                    <th width='5%'>Action</th>
                                </tr>";
                while($row = $result->fetch_assoc()){
                    echo
                    "<form method = 'POST' action='order.php'>".
                        "<tr>".
                            "<td>".$row['item_name']."</td>".
                            "<td>".$row['item_description']."</td>";

                            if($row['spicy'] == 1)
                                $spicy = "Yes"; 
                            else 
                                $spicy = "No"; 

                    echo    "<td>".$spicy."</td>".
                            "<td>".$row['price']."</td>".
                            "<input type='hidden' name= 'hidden_id' value=".$row['item_id'].">".
                            "<input type='hidden' name= 'hidden_name' value=".$row['item_name'].">".
                            "<input type='hidden' name= 'hidden_price' value=".$row['price'].">".
                            "<td><input type='number' name='quantity' value='1' min='1'></td>".
                            "<td><input type='submit' name='add_to_cart' value='Add to Cart'></td>".
                        "</tr>";
                }
                echo "</form>
                    </table>
                </div>";
            }
            echo
                "<br>
                <h3>Your Order</h3>
                <div class='table-responsive'>
                    <table class='table table-bordered'>  
                        <tr>  
                            <th width='40%'>Item Name</th>  
                            <th width='10%'>Quantity</th>  
                            <th width='20%'>Price</th>  
                            <th width='15%'>Total</th>  
                            <th width='5%'>Action</th>  
                        </tr>";
            if(!empty($_SESSION['cart'])){  
                $total = 0;  
                foreach($_SESSION['cart'] as $keys => $values){
                    echo "<tr>  
                            <td>".$values['item_name']."</td>  
                            <td>".$values['item_quantity']."</td>  
                            <td>$".$values['price']."</td>  
                            <td>$".number_format($values['item_quantity'] * $values['price'], 2)."</td>  
                            <td><a href='order.php' action='delete' id=".$values['item_id']."><span class='text-danger'>Remove</span></a></td>  
                        </tr>";
                    $total = $total + ($values['item_quantity'] * $values['price']);
                }
                echo
                    "<tr>  
                        <td colspan='3' align='right'>Total</td>  
                        <td align='right'>$".number_format($total, 2)."</td>  
                        <td></td>  
                    </tr>
                </table>
                </div>";
            }
        ?>
        <?php
            include('includes/footer.php');
        ?>
    </body>
</html>