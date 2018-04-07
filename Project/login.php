<?php
include('Includes/header.php');
include('Includes/dbconnection.php');


?>

    <body>
        <form class="form-horizontal" action="login.php" method="post">
            <br>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Email:</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="username" placeholder="Enter username">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">Password:</label>
                <div class="col-sm-3"> 
                    <input type="password" class="form-control" name="password" placeholder="Enter password">
                </div>
            </div>
            <div class="form-group"> 
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </div>
        </form>

        
    </body>
</html>
<?php
    if($_POST){
        if(!empty($_POST['username']) && !empty($_POST['password'])){

            $username = $_POST['username'];
            $password = $_POST['password'];

            $sql_select = "SELECT * 
                            FROM users
                            JOIN usertype
                            ON users.usertype_id = usertype.usertype_id
                            WHERE users.username = '$username'";
            $result = $conn->query($sql_select);

            echo '<p> returned rows: ' . $result->num_rows . '</p>';

            if($result->num_rows > 0){

                $usrpwd = "";


                while($row = $result->fetch_assoc()){
                    $usrpwd = $row['password'];
                    $usrID = $row['user_id'];
                    $usrTypeName = $row['usertype_name'];
                }

                if($usrpwd == $password){
                    $_SESSION['userID'] = $usrID;
                    $_SESSION['name'] = $username;
                    $_SESSION['usertype'] = $usrtype;
                    $_SESSION['usertype_name'] =  $usrTypeName;

                    if($_SESSION['usertype_name'] == 'owner'){
                        header('Location: owner.php');
                    } else {
                        header('Location: home.php');
                    }

                }else{
                    echo "<p style='color:red;'>Incorrect credentials</p>";
                }
            } else {echo "<p style='color:red;'>Incorrect credentials</p>";}
        } else {
            echo "<p style='color:red;'>All fields are required.</p>";
        }
    }
?>
<?php
    include('Includes/footer.php');
?>
