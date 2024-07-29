<?php 
        echo '<form id="absenceInputForm">';   
        session_start();
        $classroom_id = $_SESSION['classroomId'];
        echo '</select>
        <label for="absenceDate">Select date:</label>
        <input type="date" id="absenceDate" name="absenceDate">
        <button type="button" onclick="addAbsence(';

        echo "$classroom_id";
        
        echo ')">Add Absence</button>
        <br>
        <button type="button" onclick="cancelAbsenceInput()">Cancel</button>
        </form>';
?>