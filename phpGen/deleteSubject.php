<div class="col">
<h2>Delete Subject</h2>
    <form id="deleteSubjectForm">
        <label for="subjects">Select Subject:</label>
        <select id="subjects" name="subjects">
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
        <button type="button" onclick="deleteSubject()">Delete Subject</button>
    </form>
</div>
</div>

    <script>
        function deleteSubject() {
            // Get the selected classroom ID
            var subjectId = document.getElementById("subjects").value;

            // Confirm deletion with user
            var confirmDelete = confirm("Are you sure you want to delete this subject?");

            // If user confirms, submit form with classroom ID to delete
            if (confirmDelete) {
                // Create a form element
                var form = document.createElement("form");
                form.setAttribute("method", "post");
                form.setAttribute("action", "./phpScripts/deleteSubject.php");

                // Create an input element for classroom ID
                var input = document.createElement("input");
                input.setAttribute("type", "hidden");
                input.setAttribute("name", "subject_id");
                input.setAttribute("value", subjectId);

                // Append input to form
                form.appendChild(input);

                // Append form to document body and submit it
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>