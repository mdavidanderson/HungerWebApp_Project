<?php
    session_start();
    include('dbconnection.php');

    echo '<h1>Welcome ' . $_SESSION['name'] . '!</h1>';
    echo '<p>You are logged in as a ' . $_SESSION['usertype_name'] . '.</p>';
?>






