<?php


// Database connection parameters for MariaDB
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "iwp_project_class_manager";

session_start();
$student_id = $_GET['studentId'];

// Create connection to MariaDB
$conn = new mysqli($servername, $username, $password, $dbname, 3307);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$absence_subject_id = $_SESSION['subject_id'];
$absence_date = $_GET['absenceDate'];


$table = 'absences';

$sql = "INSERT INTO $table (student_id, subject_id, absence_date) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("iis", $student_id, $absence_subject_id, $absence_date);
    $success = $stmt->execute();
}
?>