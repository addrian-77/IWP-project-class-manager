<div class="col">
<h2>Manage Subjects</h2>
    <form id="manageSubjectsForm">
        <label for="displaySubjects">Select Subject:</label>
        <select id="displaySubjects" name="displaySubjects" onchange="displayProfessors(this.value)">
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
            $table = 'subjects';
            $sql = "SELECT id, name FROM $table";
            $result = $conn->query($sql);

            // Check if there are any classrooms
            if ($result->num_rows > 0) {
                // Output each classroom as an option in the dropdown
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="';
                    $subjectId = $row["id"];
                    echo "$subjectId";
                    echo '">';
                    $subjectName = $row["name"];
                    echo "$subjectName";
                    echo "</option>";
                }
            }
            // Close the database connection
            $conn->close();
            ?>
        </select>
        <br><br>
        </form>
        <div id="myModalSub" class="modal">
            <div class="modal-content">
                <span onclick="modalSubOff()">&times;</span>
                    <div id="subjectContent"></div>
                    <div id="nameInputAreaProfessors"></div>
                    <div id="goBackSub"></div>
            </div>
        </div>
</div>
        <script src="./phpScripts/adminPageScripts.js"></script>

