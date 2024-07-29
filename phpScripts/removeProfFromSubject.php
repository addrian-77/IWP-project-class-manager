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

$professor_id = $_GET['professorId'];

$table = 'iwp_project_class_manager.professors';
$sql = "UPDATE $table SET subject_id = 0 WHERE id = $professor_id";
$conn->query($sql);
$conn->close();

?>