<?php
session_start();



?>

<!DOCTYPE html>
<html lang="en">
    <head>
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

        <?php
            if (!isset($_SESSION["userID"])){
                echo '<nav class="navbar navbar-inverse">
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
                                    <li ><a href="home.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                                    <li ><a href="menu.php"><span class="glyphicon glyphicon-list-alt"></span> Menu</a></li>
                                </ul>
                                <ul class="nav navbar-nav navbar-right">
                                    <li ><a href="order.php"><span class="glyphicon glyphicon-shopping-cart"></span> Checkout</a></li>
                                    <li class="active"><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                                </ul>
                            </div>
                        </div>
                    </nav>';
            }
            else if($_SESSION["usertype_name"] == "owner"){
                echo '<nav class="navbar navbar-inverse">
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
                                    <li ><a href="home.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                                    <li ><a href="menu.php"><span class="glyphicon glyphicon-list-alt"></span> Menu</a></li>
                                    <li ><a href="owner.php"><span class="glyphicon glyphicon-cog"></span> Manage</a></li>
                                </ul>
                                <ul class="nav navbar-nav navbar-right">
                                    <li ><a href="order.php"><span class="glyphicon glyphicon-shopping-cart"></span> Checkout</a></li>
                                    <li class="active"><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </nav>';
            } else {
                echo '<nav class="navbar navbar-inverse">
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
                                    <li ><a href="home.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                                    <li ><a href="menu.php"><span class="glyphicon glyphicon-list-alt"></span> Menu</a></li>
                                </ul>
                                <ul class="nav navbar-nav navbar-right">
                                    <li ><a href="order.php"><span class="glyphicon glyphicon-shopping-cart"></span> Checkout</a></li>
                                    <li class="active"><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </nav>';
            }

        ?>
    </body>
</html>




