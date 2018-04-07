<?php
	include('Includes/header.php');
	include('Includes/dbconnection.php');

	if($_SESSION['usertype_name'] != "owner" )
		header('Location: login.php');
	else {
		$menuitemsqry = "SELECT i.item_id, i.item_name, i.item_description, m.meat_name, i.spicy ".
                        "FROM item i, meats m " .
                        "WHERE i.item_id=".$_GET['itemID']." AND m.meat_id=i.meat_id";
		$item_result = $conn->query($menuitemsqry)->fetch_assoc();

        $meat_selection = "SELECT meat_id, meat_name FROM meats ORDER BY meat_name";
        $meat_result = $conn->query($meat_selection);
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

        <form class ="form-horizontal" action="update.php" method="POST">
            <?php $_SESSION['item_id']=$item_result['item_id'];?>
            <br>
            <div class="form-group">
                 <label class = "control-label col-sm-2" for="item_name">Item Name:</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" name="item_name" value="<?php echo $item_result['item_name'];?>">
                  </div>
            </div>  
            <div class="form-group">
                <label class="control-label col-sm-2" for="item_description">Description: </label>
                <div class="col-sm-5">
                    <textarea class="form-control" rows="3" name="item_description"><?php echo $item_result['item_description']?></textarea>
                </div> 
            </div>

            <div class="form-group">
                <label class = "control-label col-sm-2" for="meat_name">Meat Type:</label>
                <div class = "col-sm-3">
                    <select class="form-control" name="meat_name">
                     <?php while($meat_row = $meat_result->fetch_assoc()) {
                        echo "<option value=".$meat_row['meat_id'];
                        if($meat_row['meat_name']==$item_result['meat_name'])
                        {
                            echo " selected>";
                        }
                        else
                        {
                            echo ">";
                        }
                        echo $meat_row['meat_name']."</option>";
                    }
                    ?>
                </select>
                </div>
            </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="spicy">Spicy:</label>
            <div class="col-sm-3">
                <select class="form-control" name="spicy">
                    <?php
                        echo "<option value=1";
                        if($item_result['spicy']==1)
                            echo " selected";
                        echo ">Yes</option>";
                        echo "<option value=0";
                        if($item_result['spicy']==0)
                            echo " selected";
                        echo ">No</option>";
                    ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="button"></label>
            <div class="col-sm-3">
            <input type="submit" name="button" value="Update">
            <input type="submit" name="button" value="Delete">
            <input type="submit" name="button" value="Cancel">
        </div>
        </div> 
        </form>
    </body>
</html>
<?php
    include('Includes/footer.php');


?>