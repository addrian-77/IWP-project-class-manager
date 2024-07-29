<?php echo '<form id="absenceInputForm">
        <label for="professorId">Select professor:</label>
        <select id="professorId" name="professorId">
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
            $table = 'professors';
            $sql = "SELECT id, name FROM $table WHERE subject_id = 0 AND id != 0";
            $result = $conn->query($sql);

            // Check if there are any subjects
            if ($result->num_rows > 0) {
                // Output each classroom as an option in the dropdown
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="';
                    $professorId = $row["id"];
                    echo "$professorId";
                    echo '">';
                    $professorName = $row["name"];
                    echo "$professorName";
                    echo "</option>";
                }
            }
            // Close the database connection
            $conn->close();
            ?>
<?php   echo '</select>
        <button type="button" onclick="addProfToSubject()">Add professor</button>
        <br>
        <button type="button" onclick="toggleInputProfessors(0)">Cancel</button>
        </form>';
?>