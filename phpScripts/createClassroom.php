<?php

// Database connection parameters for MariaDB
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "iwp_project_class_manager";

try {
    // Create connection to MariaDB
    $conn = new mysqli($servername, $username, $password, $dbname, 3307);

    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if the classroom name is set and not empty
        if (isset($_POST["classroomName"]) && !empty($_POST["classroomName"])) {
            // Sanitize the input to prevent SQL injection
            $classroomName = $conn->real_escape_string($_POST["classroomName"]);

            // Prepare the SQL statement
            $sql = "INSERT INTO classrooms (name) VALUES ('$classroomName')";

            // Execute the SQL statement
            if ($conn->query($sql) === TRUE) {
                echo 'New record created successfully<br>
                    <a href="../adminDashboard.php" class="button">Go back</a>';
            } else {
                // Check for duplicate entry error
                if ($conn->errno === 1062) {
                    echo "Error: Classroom name already exists. Please choose a different name.<br>
                        <a href='../adminDashboard.php' class='button'>Go back</a>";
                } else {
                    throw new Exception("Error: " . $sql . "<br>" . $conn->error);
                }
            }
        } else {
            echo "Classroom name is required<br>
                <a href='../adminDashboard.php' class='button'>Go back</a>";
        }
    }
} catch (Exception $e) {
    // Display a user-friendly error message
    echo $e->getMessage() . "<br>
        <a href='../adminDashboard.php' class='button'>Go back</a>";
} finally {
    // Ensure the connection is closed
    if ($conn) {
        $conn->close();
    }
}
?>