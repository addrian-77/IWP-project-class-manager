<?php
    // Get the classroom ID from the POST request
    if ($_GET) {
        $studentId = $_GET['studentId'];
    }
    else {
        session_start();
        $studentId = $_SESSION['studentId'];
    } 

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
    
    $getStudentName = "SELECT name FROM students WHERE id = $studentId";
    $result = $conn->query($getStudentName);
    $studentName = $result->fetch_assoc()['name'];

    $sql_subjects = "SELECT  id, name FROM subjects";
    $subjects = $conn->prepare($sql_subjects);
    $subjects->execute();
    $subjects->store_result();
    $subjects->bind_result($subjectId, $subjectName);

    echo "<h>Now managing student <strong>$studentName</strong>'s grades (id = $studentId)</h2>";
    echo '<table class="parent-table">';
    echo '<tr>
            <th>Subject</th>
            <th><table><th>Grades</th>
            <th>Action</th></table></th>
        </tr>';
    while ($subjects->fetch()) {
        $sql_grades = "SELECT grade_id, grade_value FROM grades WHERE student_id = $studentId AND subject_id = $subjectId";
        $grades = $conn->prepare($sql_grades);
        $grades->execute();
        $grades->store_result();
        $grades->bind_result($gradeId, $gradeValue);

        echo "<tr>";
        echo "<td>$subjectName</td>";
        
        if ($grades->num_rows > 0) {
            echo "<td><table>";
            while($grades->fetch()) {
                echo "<tr><td>$gradeValue</td><td>";
                echo '<button type="button" onclick="removeGrade(';
                echo "$gradeId";
                echo ')">Remove Grade</button></td></tr>';
            }
            echo "</table></td>";
        }
        else {
            echo "<td> - </td>";
        }
        
        echo "</tr>";
        
    }
    $conn->close();
?>
