<div class="col">
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

            // Query to retrieve classrooms from the database
            $table = 'classrooms';
            $sql = "SELECT id, name FROM $table";
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
                    <div class="row">
                        <div class="col">
                            <div id="classroomContent"></div>
                            <div id="nameInputArea"></div>
                        </div>
                        <div class="col">
                            <div id="classroomProfessors"></div>
                            <div id="nameInputAreaClassroomProfessor"></div>
                        </div>
                        <div id="myModal2" class="modal2">
                            <div class="modal-content">
                                <span onclick="modal2Off()">&times;</span>
                                <div id="myModal3" class="modal3">
                                    <div class="modal-content">
                                        <span onclick="modal3Off()">&times;</span>
                                        <div id="absencesContent"></div>
                                        <div id="absenceInput"></div>
                                        <div id="goBack3"></div>
                                    </div>
                                </div>
                                <div id="myModal4" class="modal4">
                                    <div class="modal-content">
                                        <span onclick="modal4Off()">&times;</span>
                                        <div id="gradesContent"></div>
                                        <div id="gradeInput"></div>
                                        <div id="goBack4"></div>
                                    </div>
                                </div>
                                <div id="studentContent"></div>
                                <div id="goBack2"></div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
</div>
        <script src="./phpScripts/adminPageScripts.js"></script>

