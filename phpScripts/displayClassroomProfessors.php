<?php
// Check if classroomId is provided in the POST request
    // Get the classroom ID from the POST request

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
    
    if ($_GET)
        $classroomId = $_GET['classroomId'];
    else {
        session_start();
        $classroomId = $_SESSION['classroomId'];
    }
    $sql = "SELECT p.id, p.name, s.name FROM professors p JOIN professors_classrooms pc ON p.id = pc.professor_id JOIN subjects s ON p.subject_id = s.id WHERE pc.classroom_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $classroomId);

    
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($aux_id, $aux_name, $aux_subject_name);
    $sql2 = "SELECT name FROM classrooms WHERE id=$classroomId";
    $result = $conn->query($sql2);
    $classroomName = $result->fetch_assoc()['name'];
    echo "<h>Now managing classroom $classroomName's professors, id = $classroomId</h2>";
    if($stmt->num_rows > 0) {
        echo '<table class="parent-table">';
        echo '<tr>
                <th>Professor ID</th>
                <th>Name</th>
                <th>Subject</th>
                <th>Action</th>
            </tr>';
        while ($stmt->fetch()) {
            echo "<tr> <td>$aux_id</td> <td>$aux_name</td> <td>$aux_subject_name</td>"; 
            echo '<td><button type="button" onclick="removeProfFromClassroom(';
            echo "$aux_id, $classroomId)";
            echo '">Remove</button></td> </tr>';
        }
        echo "</table>";
    }
    else {
        echo "<p>No professors assigned to the classroom</p>";
    }

    $stmt->close();
    $result->close();
    $conn->close();

?>
