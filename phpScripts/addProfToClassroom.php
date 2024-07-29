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

session_start();
$classroom_id = $_SESSION['classroomId'];

$professor_id = $_GET['professorId'];

    $sql = "INSERT INTO professors_classrooms (professor_id, classroom_id) VALUES ($professor_id, $classroom_id)";
    $conn->query($sql);
?>