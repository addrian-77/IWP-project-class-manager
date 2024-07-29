<?php

session_start();
// Check if the user ID is set in the session
if (isset($_SESSION['user_id']) && isset($_SESSION['loginType'])) {
    $id = $_SESSION['user_id'];
    $loginType = $_SESSION['loginType'];

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


    if ($loginType == 'Professor')
        $table = 'iwp_project_class_manager.professors';
    else
        $table = 'iwp_project_class_manager.students';
    // Prepare and bind
    $stmt = $conn->prepare("SELECT id FROM $table WHERE id = ?");
    $stmt->bind_param("s", $id);

    // Execute the statement
    $stmt->execute();
    $stmt->store_result();

    // Update the logged_in status
    $update_stmt = $conn->prepare("UPDATE $table SET is_logged_in = FALSE WHERE id = ?");
    $update_stmt->bind_param("i", $id);
    $update_stmt->execute();

    // Close statements and connection
    $stmt->close();
    $conn->close();
}
$_SESSION = array();
session_destroy();

header("Location: ../login.php");
exit();
?>