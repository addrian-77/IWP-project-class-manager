<?php

echo '<div class="row">
    <div class="col">
    <form action="./phpScripts/addProfessor.php" method="POST">
        <div class="mb-3">
            <h2>Add new professor:</h2>
            <input type="text" class="form-control" id="professorName" name="professorName" placeholder="Enter professor name" required>
        </div>
        <button type="submit">Create</button>
    </form>
    </div>';
?>