<?php

echo '<div class="row">
    <div class="col">
    <form action="./phpScripts/createSubject.php" method="post">
        <div class="mb-3">
            <h2>Create new subject:</h2>
            <input type="text" class="form-control" id="subjectName" name="subjectName" placeholder="Enter subject name" required>
        </div>
        <button type="submit">Create</button>
    </form>
    </div>';
?>