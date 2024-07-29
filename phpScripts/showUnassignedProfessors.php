<?php echo '<form id="absenceInputForm">
        <label for="unassignedProfessorId">Select professor:</label>
        <select id="unassignedProfessorId" name="unassignedProfessorId">
            <option value="" disabled selected>Select your option</option>
            <!-- Populate dropdown with classroom options -->';
?>
            <?php
            // Database connection parameters
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "iwp_project_class_manager";

            session_start();
            $classroomId = $_SESSION['classroomId'];
            // Create connection
            $conn = new mysqli($servername, $username, $password, $database,3307);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Query to retrieve subjects from the database
            $sql = "SELECT p.id, p.name, p.subject_id FROM professors p LEFT JOIN professors_classrooms pc ON p.id = pc.professor_id AND pc.classroom_id = $classroomId WHERE pc.classroom_id IS NULL AND p.id != 0 AND p.subject_id != 0";
            
            $result = $conn->query($sql);

            // Check if there are any subjects
            if ($result->num_rows > 0) {
                // Output each classroom as an option in the dropdown
                while ($row = $result->fetch_assoc()) {
                    $subject_id = $row['subject_id'];
                    $getSubjectName = "SELECT name FROM subjects WHERE id = $subject_id";
                    $subject_name = $conn->query($getSubjectName)->fetch_assoc()['name'];
                    if (!$subject_name)
                        $subject_name = 'UNASSIGNED';
                    echo '<option value="';
                    $professorId = $row["id"];
                    echo "$professorId";
                    echo '">';
                    $professorName = $row["name"];
                    echo "$professorName ($subject_name)";
                    echo "</option>";
                }
            }
            // Close the database connection
            $conn->close();
            ?>
<?php   echo '</select>
        <button type="button" onclick="addProfToClassroom()">Add professor</button>
        <br>
        </form>';
?>