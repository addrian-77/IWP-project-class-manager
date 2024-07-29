<?php
// Check if classroomId is provided in the POST request
    // Get the classroom ID from the POST request
    session_start();

    if ($_GET)
        $subjectId = $_GET['subjectId'];
    else
        $subjectId = $_SESSION['subjectId'];

    $_SESSION['subjectId'] = $subjectId;

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
    
    
    $table = 'iwp_project_class_manager.professors';
    $sql = "SELECT id, name FROM $table WHERE subject_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $subjectId);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($aux_id, $aux_name);
    $sql2 = "SELECT name FROM subjects WHERE id=$subjectId";
    $result = $conn->query($sql2);
    $subjectName = $result->fetch_assoc()['name'];
    echo "<h>Now managing subject $subjectName, id = $subjectId</h2>";
    if($stmt->num_rows > 0) {
        echo '<table class="parent-table">';
        echo '<tr>
                <th>ID</th>
                <th>Name</th>
                <th>Action</th>
            </tr>';
        while ($stmt->fetch()) {
            echo "<tr> <td>$aux_id</td> <td>$aux_name</td>"; 
            echo '<td><button type="button" onclick="removeProfFromSubject(';
            echo "$aux_id, $subjectId)";
            echo '">Remove</button></td> </tr>';
        }
        echo "</table>";
    }
    else {
        echo "<p>No professors assigned to the subject</p>";
    }

    $stmt->close();
    $result->close();
    $conn->close();

?>
