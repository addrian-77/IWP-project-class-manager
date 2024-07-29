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

$absence_id = $_GET['absenceId'];

$table = 'iwp_project_class_manager.absences';
$sql = "DELETE FROM $table WHERE absence_id = $absence_id";
$conn->query($sql);
$conn->close();

?>