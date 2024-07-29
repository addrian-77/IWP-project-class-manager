<?php
// Check if classroomId is provided in the POST request
if (isset($_GET['classroomId'])) {
    // Get the classroom ID from the POST request
    $classroomId = $_GET['classroomId'];

    session_start();
    $_SESSION['classroomId'] = $classroomId;

    // Perform database query to fetch members of the selected classroom based on ID
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "iwp_project_class_manager";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database,3307);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $table = 'iwp_project_class_manager.students';
    $sql = "SELECT id, name FROM $table WHERE classroom_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $classroomId);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($aux_id, $aux_name);
    $sql2 = "SELECT name FROM classrooms WHERE id=$classroomId";
    $result = $conn->query($sql2);
    $classroomName = $result->fetch_assoc()['name'];
    echo "<h>Now managing class $classroomName's students, id = $classroomId</h2>";
    if($stmt->num_rows > 0) {
        echo '<table class="parent-table">';
        echo '<tr>
                <th>Student ID</th>
                <th>Name</th>
                <th>Action</th>
            </tr>';
        while ($stmt->fetch()) {
            echo "<tr> <td>$aux_id</td> <td>$aux_name</td>"; 
            echo '<td><button type="button" onclick="manageStudent(';
            echo "$aux_id, $classroomId)";
            echo '">Manage</button></td> </tr>';
        }
        echo "</table>";
    }
    else {
        echo "<p>Empty classroom</p>";
    }

    $stmt->close();
    $result->close();
    $conn->close();

} else {
    // Output an error message if classroomId is not provided
    echo "Error: Classroom ID is required";
}
?>
