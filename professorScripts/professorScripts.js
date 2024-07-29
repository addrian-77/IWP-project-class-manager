function displayStudents(classroom_id) {
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        document.getElementById("classroomContent").innerHTML = this.responseText;
            modalOn();
        }
    };
    xhttp.open("GET", "./professorScripts/displayTableStudents.php?classroomId=" + classroom_id, true);
    xhttp.send();
}

function manageStudent(student_id, classroom_id) {
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        document.getElementById("studentContent").innerHTML = this.responseText;
        document.getElementById("goBack2").innerHTML = '<button type="button" onclick="modal2Off()">Go back</button>';
        modal2On();
        }
    };
    xhttp.open("GET", "./professorScripts/manageStudent.php?studentId=" + student_id + "&classroom_id=" + classroom_id, true);
    xhttp.send();
}

function toggleAbsenceInput() {
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("studentControl").innerHTML = this.responseText;
            document.getElementById("goBack2").innerHTML = " ";
        }
    };
    xhttp.open("GET", "./professorScripts/absenceInput.php",true);
    xhttp.send();
}

function cancelAbsenceInput() {
    var result = '<button type="button" onclick="toggleAbsenceInput()">Add Absence</button><button type="button" onclick="toggleGradeInput()">Add Grade</button>';
    document.getElementById("studentControl").innerHTML = result;
    document.getElementById("goBack2").innerHTML = '<button type="button" onclick="modal2Off()">Go back</button>';
}

function addAbsence() {
    var classroom_id = document.getElementById("displayClassrooms").value;
    p = document.getElementById("getStudentId");
    var text = p.textContent;
    var student_id = Number(text);
    // console.log(student_id);
    var absenceDate = document.getElementById("absenceDate").value;
    // console.log(absenceDate);
    // console.log(absenceSubject);
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            manageStudent(student_id, classroom_id);
        }
    };
    xhttp.open("GET", "./professorScripts/addAbsence.php?absenceDate=" + absenceDate + "&studentId=" + student_id,true);
    xhttp.send();
}

function toggleGradeInput() {
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("studentControl").innerHTML = this.responseText;
            document.getElementById("goBack2").innerHTML = " ";
        }
    };
    xhttp.open("GET", "./professorScripts/gradeInput.php",true);
    xhttp.send();
}

function addGrade() {
    var classroom_id = document.getElementById("displayClassrooms").value;
    p = document.getElementById("getStudentId");
    var text = p.textContent;
    var student_id = Number(text);
    // console.log(student_id);
    gradeValue = document.getElementById("gradeValue").value;
    // console.log(gradeValue);
    // console.log(gradeValue);
    // console.log(gradeSubject);
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            manageStudent(student_id, classroom_id);
        }
    };
    xhttp.open("GET", "./professorScripts/addGrade.php?gradeValue=" + gradeValue + "&studentId=" + student_id,true);
    xhttp.send();
}
// Get the modal
var modal = document.getElementById("myModal");
var modal2 = document.getElementById("myModal2");

// When the user clicks the button, open the modal
function modalOn() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
function modalOff() {
    modal.style.display = "none";
    document.getElementById("displayClassrooms").value = "";
}

// When the user clicks the button, open the modal
function modal2On() {
    modal2.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
function modal2Off() {
    modal2.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
        document.getElementById("displayClassrooms").value = "";
    }

    if (event.target == modal2) {
        modal2.style.display = "none";
    }
}