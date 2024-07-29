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

$professor_name = $_POST['professorName'];

$table = 'iwp_project_class_manager.professors';
$sql2 = "SELECT MAX(id) AS max_id FROM $table";
$result = $conn->query($sql2);
if ($result) {
    $row = $result->fetch_assoc();
    $max_id = $row['max_id'];
}
$max_id++;
$email = "professor" . $max_id . "@example.com";

$sql = "INSERT INTO $table (name, email, password, is_logged_in) VALUES (?, ?, 'password', FALSE)";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("ss", $professor_name, $email);
    $success = $stmt->execute();

    if ($success) {
        echo "Professor $professor_name added succesfully<br>";
        echo '<a href="../adminDashboard.php" class="button">Go back</a>';
    }
}
?>