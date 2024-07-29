<?php


// Database connection parameters for MariaDB
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "iwp_project_class_manager";


session_start();
$subject_id = $_SESSION['subjectId'];

// Create connection to MariaDB
$conn = new mysqli($servername, $username, $password, $dbname, 3307);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$professor_id = $_GET['professorId'];


$table = 'professors';

$sql = "UPDATE $table SET subject_id = $subject_id WHERE id = $professor_id";
$conn->query($sql);
?>