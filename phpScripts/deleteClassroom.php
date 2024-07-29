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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the classroom name is set and not empty
    if (isset($_POST["classroom_id"])) {
        // Sanitize the input to prevent SQL injection
        $classroomId = $_POST["classroom_id"];
        $table = 'iwp_project_class_manager.classrooms';

        // Prepare the SQL statement
        $sql = "DELETE FROM $table WHERE id = $classroomId";

        // Execute the SQL statement
        if ($conn->query($sql) === TRUE) {
            echo 'Classroom deleted succesfully<br>
                <a href="../adminDashboard.php" class="button">Go back</a>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Classroom name is required";
    }
}
?>