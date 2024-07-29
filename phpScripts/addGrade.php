<?php


// Database connection parameters for MariaDB
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "iwp_project_class_manager";


session_start();
$student_id = $_SESSION['studentId'];

// Create connection to MariaDB
$conn = new mysqli($servername, $username, $password, $dbname, 3307);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$grade_subject_id = $_GET['gradeSubject'];
$grade_value = $_GET['gradeValue'];


$table = 'grades';

$sql = "INSERT INTO $table (student_id, subject_id, grade_value) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("iii", $student_id, $grade_subject_id, $grade_value);
    $success = $stmt->execute();
}
?>