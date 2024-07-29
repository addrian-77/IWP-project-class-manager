<?php


// Database connection parameters for MariaDB
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "iwp_project_class_manager";

// Create connection to MariaDB
$conn = new mysqli($servername, $username, $password, $dbname, 3307);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$grade_id = $_GET['gradeId'];

$table = 'iwp_project_class_manager.grades';
$sql = "DELETE FROM $table WHERE grade_id = $grade_id";
$conn->query($sql);
$conn->close();


?>