<?php

echo '<div class="row">
    <div class="col">
    <form action="./phpScripts/createClassroom.php" method="post">
        <div class="mb-3">
            <h2>Create new classroom:</h2>
            <input type="text" class="form-control" id="classroomName" name="classroomName" placeholder="Enter classroom name" required>
        </div>
        <button type="submit">Create</button>
    </form>
    </div>';
?>