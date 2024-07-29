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

// Fetch user inputs
$email = $_POST['email'];
$password = $_POST['password'];
$loginType = $_POST['loginType'];

// Hash the password (assuming passwords are stored hashed in the database)
// $hashed_password = hash('sha256', $password);  // Use a better hashing algorithm like bcrypt in a real application

// Determine the table to query based on login type
if ($loginType === 'Professor')
    $table = 'iwp_project_class_manager.professors';
else
    $table = 'iwp_project_class_manager.students';

// Prepare and bind
$stmt = $conn->prepare("SELECT id, email, name FROM $table WHERE email = ? AND password = ?");
$stmt->bind_param("ss", $email, $password);

// Execute the statement
$stmt->execute();
$stmt->store_result();

// Check if a user exists with the provided credentials
if ($stmt->num_rows > 0) {
    // Update the login status
    $stmt->bind_result($id, $email, $name);
    $stmt->fetch();

    $update_stmt = $conn->prepare("UPDATE $table SET is_logged_in = TRUE WHERE id = ?");
    $update_stmt->bind_param("i", $id);
    $update_stmt->execute();

    session_start();
    $_SESSION['user_id'] = $id;
    $_SESSION['email'] = $email;
    $_SESSION['name'] = $name;
    if ($id == 0)
        $_SESSION['loginType'] = 'admin';
    else
        $_SESSION['loginType'] = $loginType;

    header("Location: ../homepage.php");
    exit();
} else {
    echo "Invalid email or password.";
}

// Close statements and connection
$stmt->close();
$conn->close();
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: ../login.php");
    exit();
}
?>
