function displayStudents(classroom_id) {
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        document.getElementById("classroomContent").innerHTML = this.responseText;
        document.getElementById("nameInputArea").innerHTML = '<button type="button" onclick="toggleInput(1)">Add a student</button>';
        }
    };
    xhttp.open("GET", "./phpScripts/displayTableStudents.php?classroomId=" + classroom_id, true);
    xhttp.send();

    var xhttp2;
    xhttp2 = new XMLHttpRequest();
    // console.log("ppp");
    xhttp2.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("classroomProfessors").innerHTML = this.responseText;
            document.getElementById("nameInputAreaClassroomProfessor").innerHTML = '<button type="button" onclick="toggleClassroomProfessorInput(1)">Add a professor</button>';
            modalOn();
        }
    };
    xhttp2.open("GET", "./phpScripts/displayClassroomProfessors.php?classroomId=" + classroom_id, true);
    xhttp2.send();
    
}

function displayProfessors(subject_id) {
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        document.getElementById("subjectContent").innerHTML = this.responseText;
        document.getElementById("nameInputAreaProfessors").innerHTML = '<button type="button" onclick="toggleInputProfessors(1)">Add a professor</button>';
        modalSubOn();
        }
    };
    xhttp.open("GET", "./phpScripts/displayTableProfessors.php?subjectId=" + subject_id, true);
    xhttp.send();
    
}

function toggleInput(variable) {
    if (variable == 1) {
        var response = "";
        response += '<form><div class="mb-3"><p>Add new student:</p><input type="text" class="form-control" id="studentNameInput" name="studentNameInput" placeholder="Enter student name" required></div><button type="button" onclick=addStudent()>Add student</button></form>';
        response += '<button type="button" onclick="toggleInput(0)">Cancel</button>';
    }
    else if (variable == 0) {
        var response = ""; 
        response += '<button type="button" onclick="toggleInput(1)">Add student</button>';
    } 
    document.getElementById("nameInputArea").innerHTML = response;
}

function toggleInputProfessors(variable) {
    if (variable == 1) {
        var xhttp;
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("nameInputAreaProfessors").innerHTML = this.responseText;
                document.getElementById("goBack2").innerHTML = '<button type="button" onclick="modal2Off()">Go back</button>';
            }
        };
        xhttp.open("GET", "./phpScripts/showAvailableProfessors.php", true);
        xhttp.send();
    }
    else if (variable == 0) {
        var response = ""; 
        response += '<button type="button" onclick="toggleInputProfessors(1)">Add professor</button>';
        document.getElementById("nameInputAreaProfessors").innerHTML = response;
    } 
}

function toggleClassroomProfessorInput(variable) {
    if (variable == 1) {
        var xhttp;
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("nameInputAreaClassroomProfessor").innerHTML = this.responseText;
                document.getElementById("nameInputAreaClassroomProfessor").innerHTML += '<button type="button" onclick="toggleClassroomProfessorInput(0)">Cancel</button>';
            }
        };
        xhttp.open("GET", "./phpScripts/showUnassignedProfessors.php", true);
        xhttp.send();
    }
    else if (variable == 0) {
        var response = ""; 
        response += '<button type="button" onclick="toggleClassroomProfessorInput(1)">Add professor</button>';
        document.getElementById("nameInputAreaClassroomProfessor").innerHTML = response;
    } 
}

function addProfToSubject() {
    professorId = document.getElementById("professorId").value;
    // console.log(absenceDate);
    // console.log(absenceSubject);
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            
        }
    };
    xhttp.open("GET", "./phpScripts/addProfToSubject.php?professorId=" + professorId, true);
    xhttp.send();

    var xhttp2;
    xhttp2 = new XMLHttpRequest();
    xhttp2.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("subjectContent").innerHTML = this.responseText;
            toggleInputProfessors(0);
        }
    };
    xhttp2.open("GET", "./phpScripts/displayTableProfessors.php", true);
    xhttp2.send();
}

function addProfToClassroom() {
    professorId = document.getElementById("unassignedProfessorId").value;
    // console.log(absenceDate);
    // console.log(absenceSubject);
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            
        }
    };
    xhttp.open("GET", "./phpScripts/addProfToClassroom.php?professorId=" + professorId, true);
    xhttp.send();

    var xhttp2;
    xhttp2 = new XMLHttpRequest();
    xhttp2.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("classroomProfessors").innerHTML = this.responseText;
            toggleClassroomProfessorInput(0);
        }
    };
    xhttp2.open("GET", "./phpScripts/displayClassroomProfessors.php", true);
    xhttp2.send();
}

function removeProfFromSubject(professor_id) {
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            
        }
    };
    xhttp.open("GET", "./phpScripts/removeProfFromSubject.php?professorId=" + professor_id, true);
    xhttp.send();

    var xhttp2;
    xhttp2 = new XMLHttpRequest();
    xhttp2.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("subjectContent").innerHTML = this.responseText;
        }
    };
    xhttp2.open("GET", "./phpScripts/displayTableProfessors.php", true);
    xhttp2.send();
}

function removeProfFromClassroom(professor_id, classroom_id) {
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            
        }
    };
    xhttp.open("GET", "./phpScripts/removeProfFromClassroom.php?professorId=" + professor_id + "&classroomId=" + classroom_id, true);
    xhttp.send();

    var xhttp2;
    xhttp2 = new XMLHttpRequest();
    xhttp2.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("classroomProfessors").innerHTML = this.responseText;
        }
    };
    xhttp2.open("GET", "./phpScripts/displayClassroomProfessors.php", true);
    xhttp2.send();
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
    xhttp.open("GET", "./phpScripts/manageStudent.php?studentId=" + student_id + "&classroom_id=" + classroom_id, true);
    xhttp.send();
}

function manageProfessor(professor_id, subject_id) {
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        document.getElementById("professorContent").innerHTML = this.responseText;
        document.getElementById("goBack2").innerHTML = '<button type="button" onclick="modal2Off()">Go back</button>';
        modal2On();
        }
    };
    xhttp.open("GET", "./phpScripts/manageStudent.php?studentId=" + student_id + "&classroom_id=" + classroom_id, true);
    xhttp.send();
}

function manageAbsences(student_id) {
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        document.getElementById("absencesContent").innerHTML = this.responseText;
        document.getElementById("absenceInput").innerHTML ='<button type="button" onclick="toggleAbsenceInput()">Add Absence</button>';
        document.getElementById("goBack3").innerHTML = '<button type="button" onclick="modal3Off()">Go back</button>';
        modal3On();
        }
    };
    xhttp.open("GET", "./phpScripts/manageAbsences.php?studentId=" + student_id, true);
    xhttp.send();
}

function toggleAbsenceInput() {
    input = document.getElementById("absenceInput").innerHTML;
    if (input != '<button type="button" onclick="toggleAbsenceInput()">Add Absence</button>') {
        input = document.getElementById("absenceInput").innerHTML ='<button type="button" onclick="toggleAbsenceInput()">Add Absence</button>';
        document.getElementById("goBack3").innerHTML = '<button type="button" onclick="modal3Off()">Go back</button>';
    }
    else {
        var xhttp;
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("absenceInput").innerHTML = this.responseText;
                document.getElementById("goBack3").innerHTML = " ";
            }
        };
        xhttp.open("GET", "./phpScripts/absenceInput.php",true);
        xhttp.send();
    }
}

function addAbsence() {
    absenceSubject = document.getElementById("absenceSubject").value;
    absenceDate = document.getElementById("absenceDate").value;
    // console.log(absenceDate);
    // console.log(absenceSubject);
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            
        }
    };
    xhttp.open("GET", "./phpScripts/addAbsence.php?absenceSubject=" + absenceSubject + "&absenceDate=" + absenceDate,true);
    xhttp.send();

    var xhttp2;
    xhttp2 = new XMLHttpRequest();
    xhttp2.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("absencesContent").innerHTML = this.responseText;
            toggleAbsenceInput();
        }
    };
    xhttp2.open("GET", "./phpScripts/manageAbsences.php", true);
    xhttp2.send();
}

function removeAbsence(absenceId) {
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            
        }
    };
    xhttp.open("GET", "./phpScripts/removeAbsence.php?absenceId=" + absenceId,true);
    xhttp.send();

    var xhttp2;
    xhttp2 = new XMLHttpRequest();
    xhttp2.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("absencesContent").innerHTML = this.responseText;
        }
    };
    xhttp2.open("GET", "./phpScripts/manageAbsences.php", true);
    xhttp2.send();
}


function manageGrades(student_id) {
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        document.getElementById("gradesContent").innerHTML = this.responseText;
        document.getElementById("gradeInput").innerHTML ='<button type="button" onclick="toggleGradeInput()">Add Grade</button>';
        document.getElementById("goBack4").innerHTML = '<button type="button" onclick="modal4Off()">Go back</button>';
        modal4On();
        }
    };
    xhttp.open("GET", "./phpScripts/manageGrades.php?studentId=" + student_id, true);
    xhttp.send();
}

function toggleGradeInput() {
    input = document.getElementById("gradeInput").innerHTML;
    if (input != '<button type="button" onclick="toggleGradeInput()">Add Grade</button>') {
        input = document.getElementById("gradeInput").innerHTML ='<button type="button" onclick="toggleGradeInput()">Add Grade</button>';
        document.getElementById("goBack4").innerHTML = '<button type="button" onclick="modal4Off()">Go back</button>';
    }
    else {
        var xhttp;
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("gradeInput").innerHTML = this.responseText;
                document.getElementById("goBack4").innerHTML = " ";
            }
        };
        xhttp.open("GET", "./phpScripts/gradeInput.php",true);
        xhttp.send();
    }
}

function addGrade() {
    gradeSubject = document.getElementById("gradeSubject").value;
    gradeValue = document.getElementById("gradeValue").value;
    // console.log(gradeValue);
    // console.log(gradeSubject);
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            
        }
    };
    xhttp.open("GET", "./phpScripts/addGrade.php?gradeSubject=" + gradeSubject + "&gradeValue=" + gradeValue,true);
    xhttp.send();

    var xhttp2;
    xhttp2 = new XMLHttpRequest();
    xhttp2.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("gradesContent").innerHTML = this.responseText;
            toggleGradeInput();
        }
    };
    xhttp2.open("GET", "./phpScripts/manageGrades.php", true);
    xhttp2.send();
}

function removeGrade(gradeId) {
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            
        }
    };
    xhttp.open("GET", "./phpScripts/removeGrade.php?gradeId=" + gradeId,true);
    xhttp.send();

    var xhttp2;
    xhttp2 = new XMLHttpRequest();
    xhttp2.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("gradesContent").innerHTML = this.responseText;
        }
    };
    xhttp2.open("GET", "./phpScripts/manageGrades.php", true);
    xhttp2.send();
}

function removeStudent(student_id, classroom_id) {
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var ok = 1;
            modal2Off();
            displayStudents(classroom_id);
        }
    };
    xhttp.open("GET", "./phpScripts/removeStudent.php?id=" + student_id, true);
    xhttp.send();
}

function addStudent() {
    var selectElement = document.getElementById("displayClassrooms");
    var classroom_id = selectElement.value;
    selectElement = document.getElementById("studentNameInput");
    var studentName = selectElement.value;
    console.log(classroom_id);
    console.log(studentName);
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var ok = 1;
            displayStudents(classroom_id);
        }
    };
    xhttp.open("GET", "./phpScripts/addStudent.php?student_name=" + studentName + "&classroom_id=" + classroom_id, true);
    xhttp.send();
}
// Get the modal
var modal = document.getElementById("myModal");
var modal2 = document.getElementById("myModal2");
var modal3 = document.getElementById("myModal3");
var modal4 = document.getElementById("myModal4");
var modalSub1 = document.getElementById("myModalSub");

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
function modalSubOn() {
    modalSub1.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
function modalSubOff() {
    modalSub1.style.display = "none";
    document.getElementById("displaySubjects").value = "";
}

// When the user clicks the button, open the modal
function modal2On() {
    modal2.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
function modal2Off() {
    modal2.style.display = "none";
}

// When the user clicks the button, open the modal
function modal3On() {
    modal3.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
function modal3Off() {
    modal3.style.display = "none";
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        document.getElementById("studentContent").innerHTML = this.responseText;
        document.getElementById("goBack2").innerHTML = '<button type="button" onclick="modal2Off()">Go back</button>';
        }
    };
    xhttp.open("GET", "./phpScripts/manageStudent.php", true);
    xhttp.send();
}

// When the user clicks the button, open the modal
function modal4On() {
    modal4.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
function modal4Off() {
    modal4.style.display = "none";
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        document.getElementById("studentContent").innerHTML = this.responseText;
        document.getElementById("goBack2").innerHTML = '<button type="button" onclick="modal2Off()">Go back</button>';
        }
    };
    xhttp.open("GET", "./phpScripts/manageStudent.php", true);
    xhttp.send();
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
        document.getElementById("displayClassrooms").value = "";
    }

    if (event.target == modal2) {
        modal2.style.display = "none";
    }
 
    if (event.target == modal3) {
        modal3.style.display = "none";
        var xhttp;
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            document.getElementById("studentContent").innerHTML = this.responseText;
            document.getElementById("goBack2").innerHTML = '<button type="button" onclick="modal2Off()">Go back</button>';
            }
        };
        xhttp.open("GET", "./phpScripts/manageStudent.php", true);
        xhttp.send();
    }

    if (event.target == modal4) {
        modal4.style.display = "none";
        var xhttp;
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            document.getElementById("studentContent").innerHTML = this.responseText;
            document.getElementById("goBack2").innerHTML = '<button type="button" onclick="modal2Off()">Go back</button>';
            }
        };
        xhttp.open("GET", "./phpScripts/manageStudent.php", true);
        xhttp.send();
    }

    if(event.target == modalSub1) {
        modalSub1.style.display = "none";
        document.getElementById("displaySubjects").value = "";
    }
}