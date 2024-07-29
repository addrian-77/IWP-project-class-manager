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
$classroom_id = $_GET['classroomId'];

$table = 'iwp_project_class_manager.professors_classrooms';
$sql = "DELETE from $table WHERE professor_id = $professor_id AND classroom_id = $classroom_id";
$conn->query($sql);
$conn->close();

?>