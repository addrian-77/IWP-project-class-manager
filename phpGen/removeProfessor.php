<div class="col">
<h2>Remove Professor</h2>
    <form id="deleteForm">
        <label for="professors">Select Professor:</label>
        <select id="professors" name="professors">
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
            $table = 'professors';
            $sql = "SELECT id, name FROM $table WHERE id != 0";
            $result = $conn->query($sql);

            // Check if there are any classrooms
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
        </select>
        <br><br>
        <button type="button" onclick="removeProfessor()">Remove professor</button>
    </form>
</div>
</div>

    <script>
        function removeProfessor() {
            // Get the selected classroom ID
            var professorId = document.getElementById("professors").value;

            // Confirm deletion with user
            var confirmDelete = confirm("Are you sure you want to remove this professor?");

            // If user confirms, submit form with classroom ID to delete
            if (confirmDelete) {
                // Create a form element
                var form = document.createElement("form");
                form.setAttribute("method", "post");
                form.setAttribute("action", "./phpScripts/removeProfessor.php");

                // Create an input element for classroom ID
                var input = document.createElement("input");
                input.setAttribute("type", "hidden");
                input.setAttribute("name", "professor_id");
                input.setAttribute("value", professorId);

                // Append input to form
                form.appendChild(input);

                // Append form to document body and submit it
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>