<?php
session_start();
session_unset();
include('dbconnection.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login Page</title>
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
            .form {
                padding: 25px;
            }
            footer {
                background-color: #f2f2f2;
                padding: 25px;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                        
                    </button>
                    <a class="navbar-brand" href="home.php">Hunger</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li ><a href="home.php">Home</a></li>
                        <li ><a href="#">Resturants</a></li>
                        <li ><a href="#">Order</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active"><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                    </ul>
                </div>
            </div>
        </nav>

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

        <footer class="container-fluid text-center">
            <p>We are Hunger the food ordering service you have been waiting for</p>
        </footer>
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
                $usrtype = "";

                while($row = $result->fetch_assoc()){
                    $usrpwd = $row['password'];
                    $usrtype = $row['usertype'];
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
