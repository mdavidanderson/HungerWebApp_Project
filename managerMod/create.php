<?php
	include('Includes/header.php');
	include('Includes/dbconnection.php');

	if($_SESSION['usertype_name'] != "owner" )
		header('Location: login.php');
	else {
        $meat_selection = "SELECT meat_id, meat_name FROM meats ORDER BY meat_name";
        $meat_result = $conn->query($meat_selection);
	}
?>

<html> 
	<body>
        <form class="form-horizontal" action="update.php" method="POST">
        <br>
        <div class="form-group">
            <?php $_SESSION['item_id']=$item_result['item_id'];?>
            <label class="control-label col-sm-2" for="item_name">Item Name:</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="item_name">
            </div>
        </div>  

        <div class="form-group">
            <label class="control-label col-sm-2" for="item_description">Description: </label>
            <div class="col-sm-3">
                <textarea class="form-control" rows="3" name="item_description"></textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="meat_name">Meat Type:</label>
            <div class="col-sm-3">
                <select class="form-control" name="meat_name">
                    <?php while($meat_row = $meat_result->fetch_assoc()) {
                            echo "<option value=".$meat_row['meat_id'].">".$meat_row['meat_name']."</option>";
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
                       echo "<option value=1>Yes</option>";
                       echo "<option value=0>No</option>";
                      ?>
                 </select>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="button"></label>
            <div class="col-sm-3">
                 <input type="submit" name="button" value="Create">
                 <input type="submit" name="button" value="Cancel">
            </div>
        </div> 
        </form>
    </body>
</html>
<?php
    include('Includes/footer.php');

?>