<?php 
session_start();
include '../../db.php';
include '../../functions.php';

scheck();
sqCheck();
$studentId = $_SESSION['student_id'];

$sql = "SELECT class.classCode, class.teacher_id 
        FROM studentclass
        JOIN class ON studentclass.classCode = class.classCode 
        WHERE studentclass.student_id = ?";

$classesFound = false;

if ($myclasses = $conn->prepare($sql)) {
    $myclasses->bind_param("i", $studentId);
    $myclasses->execute();
    $result = $myclasses->get_result();

    if ($result->num_rows > 0) {
        echo "<h2>Your Classes:</h2>";
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li>Class Code: " . htmlspecialchars($row['classCode']) . ", Teacher ID: " . htmlspecialchars($row['teacher_id']) . "</li>";
        }
        echo "</ul>";
        $classesFound = true;
    }
    $myclasses->close();
} else {
    echo "Error preparing statement: " . $conn->error;
}

if (!$classesFound) {
    echo "<h2>Your Classes:</h2>";
    echo "<p>You are not enrolled in any classes.</p>";
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="../gameplay/images/favicon.png" type="image/png">
    <title>Your Classes</title>
    <link rel="stylesheet" href="../../full.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
 
</body>
</html>
<div id="backButton">
  <a href="leaderboard.php" class="btn back"><i class="fa fa-backward" aria-hidden="true"></i>  Back
</a>