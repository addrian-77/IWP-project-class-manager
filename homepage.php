<?php include './phpGen/header.php';?>

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
    echo "<h> Welcome! </h>";
    echo "<br><br>";
    if ($loginType == 'Professor') {
        $professor_name = $_SESSION['name'];
        $professor_id = $_SESSION['user_id'];
        $sql = "SELECT s.name FROM subjects AS s JOIN professors AS p ON s.id = p.subject_id WHERE p.id = $professor_id";
        $subject_name = $conn->query($sql)->fetch_assoc()['name'];

        echo "<h>Professor: $professor_name</h>";
        echo "<p>Subject teached: $subject_name</p>";
    }
    else if ($loginType == 'Student') {
        $student_name = $_SESSION['name'];
        $student_id = $_SESSION['user_id'];
        $sql = "SELECT c.name FROM classrooms c JOIN students s ON s.classroom_id = c.id WHERE s.id = $student_id";
        $classroom_name = $conn->query($sql)->fetch_assoc()['name'];

        echo "<h>Student: $student_name</h>";
        echo "<p>Enrolled in classroom: $classroom_name</p>";
    }else if ($loginType == 'admin') {
        echo '<p>You are the admin (you must be very cool)</p>';
    }
?>

<?php include './phpGen/footer.php';?>