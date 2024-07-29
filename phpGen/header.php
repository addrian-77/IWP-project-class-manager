<?php
    echo'
    <!DOCTYPE html>
        <html lang="en">

        <head>
        <meta charset="UTF-8">
        <title>IWP Project</title>

        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/styles.css">
        </head>

        <body>
        <header>
            <div class="container">';    
                
        session_start();

        // Check if the user is logged in (check if user_id session variable is set)
        if (!isset($_SESSION['user_id'])) {
            // Redirect the user to the login page if not logged in
            header("Location: ./login.php");
            exit();
        }
        $user_id = $_SESSION['user_id'];
        $email = $_SESSION['email'];
        $name = $_SESSION['name'];
        echo '<ul>';
        echo '<li><a href="./homepage.php">Homepage</a></li>';
        $loginType = $_SESSION['loginType'];
        if ($loginType == 'Professor') {
            echo '<li><a href="./manageClassroom.php">Manage classrooms</a></li>';
        }
        else if ($loginType == 'Student') {
            echo '<li><a href="./studentSituation.php">Your grades</a></li>';
        }
        else if ($loginType == 'admin') {
            echo '<li><a href="./adminDashboard.php">Admin Settings</a></li>';
        }
        echo '<li><a href="./phpScripts/logoutScript.php">Logout</a></li>';
        echo '</div>
        </header>
        <div class="container">
            <div class="content">
                <br>';

?>