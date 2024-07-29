<?php echo '<form id="absenceInputForm">
        <label for="absenceSubject">Select Subject:</label>
        <select id="absenceSubject" name="absenceSubject">
            <option value="" disabled selected>Select your option</option>
            <!-- Populate dropdown with classroom options -->';
?>
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

            // Query to retrieve subjects from the database
            $table = 'subjects';
            $sql = "SELECT id, name FROM $table";
            $result = $conn->query($sql);

            // Check if there are any subjects
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
<?php   echo '</select>
        <label for="absenceDate">Select date:</label>
        <input type="date" id="absenceDate" name="absenceDate">
        <button type="button" onclick="addAbsence()">Add Absence</button>
        <br>
        <button type="button" onclick="toggleAbsenceInput()">Cancel</button>
        </form>';
?>