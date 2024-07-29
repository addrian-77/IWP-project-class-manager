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

$student_name = $_GET['student_name'];
$classroom_id = $_GET['classroom_id'];

$email = "student@example.com"; // This will be overwritten by a unique value based on the auto_increment ID
$password = "password";
$is_logged_in = 0;

$sql = "INSERT INTO students (name, email, password, is_logged_in, classroom_id) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("sssii", $student_name, $email, $password, $is_logged_in, $classroom_id);
    $success = $stmt->execute();
    if ($success) {
        // Update the email to include the new ID
        $new_id = $conn->insert_id;
        $email = "student" . $new_id . "@example.com";
        $update_sql = "UPDATE students SET email = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_sql);
        if ($update_stmt) {
            $update_stmt->bind_param("si", $email, $new_id);
            $update_stmt->execute();
            $update_stmt->close();
        }
    }
    $stmt->close();
}

$conn->close();
?>

