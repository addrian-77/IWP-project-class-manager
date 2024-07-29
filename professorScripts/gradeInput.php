<?php echo '<form id="gradeInputForm">';
        
    echo '<label for="gradeValue">Grade value:</label>
        <input type="number" id="gradeValue" name="gradeValue" min="1" max="10">
        <button type="button" onclick="addGrade()">Add Grade</button>
        <br>
        <button type="button" onclick="cancelAbsenceInput()">Cancel</button>
        </form>';
?>