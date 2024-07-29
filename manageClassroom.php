<?php include './phpGen/header.php';?>

<h2>Manage Classroom</h2>
    <form id="manageForm">
        <label for="displayClassrooms">Select Classroom:</label>
        <select id="displayClassrooms" name="displayClassrooms" onchange="displayStudents(this.value)">
            <option value="" disabled selected>Select your option</option>
            <!-- Populate dropdown with classroom options -->
            <?php
            // Database connection parameters
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

            session_start();
            $professor_id = $_SESSION['user_id'];
            // Query to retrieve classrooms from the database
            $sql = "SELECT subject_id FROM professors WHERE id = $professor_id";
            $result = $conn->query($sql);
            $subject_id = $result->fetch_assoc()["subject_id"];
            $_SESSION['subject_id'] = $subject_id;

            $sql = "SELECT c.id, c.name FROM classrooms c JOIN professors_classrooms pc ON c.id = pc.classroom_id WHERE pc.professor_id = $professor_id";
            $result = $conn->query($sql);

            // Check if there are any classrooms
            if ($result->num_rows > 0) {
                // Output each classroom as an option in the dropdown
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="';
                    $classroomId = $row["id"];
                    echo "$classroomId";
                    echo '">';
                    $classroomName = $row["name"];
                    echo "$classroomName";
                    echo "</option>";
                }
            }
            // Close the database connection
            $conn->close();
            ?>
        </select>
        <br><br>
        </form>

        <div id="myModal" class="modal">
            <div class="modal-content">
                <span onclick="modalOff()">&times;</span>
                <div id="classroomContent"></div>
                    <div id="myModal2" class="modal2">
                        <div class="modal-content">
                            <div id="studentContent"></div>
                            <div id="goBack2"></div>
                        </div>
                    </div>
            </div>
        </div>
<script src="./professorScripts/professorScripts.js"></script>
<?php include './phpGen/footer.php';?>