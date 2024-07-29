<?php
// Check if classroomId is provided in the POST request
    // Get the classroom ID from the POST request
    session_start();

    $studentId = $_GET['studentId'];

    $subjectId = $_SESSION['subject_id'];
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
    $sql = "SELECT name FROM $table WHERE id = $studentId";
    $result = $conn->query($sql);
    $studentName = $result->fetch_assoc()['name'];
    $sql_subjects = "SELECT name FROM subjects WHERE id = $subjectId";
    $subjects = $conn->prepare($sql_subjects);
    $subjects->execute();
    $subjects->store_result();
    $subjects->bind_result($subjectName);
    $subjects->fetch();
    echo '<h>Now managing student <strong>';
    echo "$studentName</strong>, id = ";
    echo '<strong id="getStudentId">';
    echo "$studentId</strong></h2>";
    echo '<table class="parent-table">';
    echo '<tr>
            <th>Subject</th>
            <th>Absences</th>
            <th>Grades</th>
        </tr>';
        $sql_absences = "SELECT absence_date FROM absences WHERE student_id = $studentId AND subject_id = $subjectId";
        $absences = $conn->prepare($sql_absences);
        $absences->execute();
        $absences->store_result();
        $absences->bind_result($absenceDate);

        $sql_grades = "SELECT grade_value FROM grades WHERE student_id = $studentId AND subject_id = $subjectId";
        $grades = $conn->prepare($sql_grades);
        $grades->execute();
        $grades->store_result();
        $grades->bind_result($gradeValue);
        echo "<tr>";
        echo "<td>$subjectName</td>";
        
        if ($absences->num_rows > 0) {
            echo "<td><table>";
            while($absences->fetch()) {
                echo "<tr><td>$absenceDate</td></tr>";
            }
            echo "</table></td>";
        }
        else {
            echo '<td> - </td>';
        }
        if($grades->num_rows > 0) {
            echo "<td><table>";
            while($grades->fetch()) {
                echo "<tr><td>$gradeValue</td></tr>";
            }
            echo "</table></td>";
        }
        else {
            echo '<td> - </td>';
        }
        echo "</tr>";

    $classroomId = $_SESSION['classroomId'];
    echo "</table>";
    echo '<div id="studentControl">
            <button type="button" onclick="toggleAbsenceInput()';
    echo '">Add Absence</button>
            <button type="button" onclick="toggleGradeInput()';
    echo '">Add Grade</button>
            </div>';

// } else {
//     // Output an error message if classroomId is not provided
//     echo "Error: Classroom ID is required";
// }
?>
