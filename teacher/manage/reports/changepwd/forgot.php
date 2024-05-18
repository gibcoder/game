<?php
session_start();
include '../../../../db.php';
include '../../../../functions.php';
tcheck();
sqCheck();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['newPassword'])) {
    $teacherId = $_SESSION['teacher_id'];
    $newPassword = password_hash($_POST['newPassword'], PASSWORD_BCRYPT);
    $studentId = $_SESSION['stuID']; 

    $passSql = "UPDATE account 
                JOIN student ON account.account_id = student.account_id
                SET account.password = ?
                WHERE student.student_id = ?";

    if ($passSQL = $conn->prepare($passSql)) {
        $passSQL->bind_param("si", $newPassword, $studentId);
        if ($passSQL->execute()) {
            if ($passSQL->affected_rows > 0) {
                echo "Password updated successfully.";
            } else {
                echo "No changes made. Unknown error";
            }
        } else {
            echo "Error executing query: " . $conn->error;
        }
        $passSQL->close();
    } else {
        echo "Error preparing query: " . $conn->error;
    }
} else {
    echo "Invalid request. Please ensure all required fields are filled.";
}
?>
<!DOCTYPE html>
<html>
<head><link rel="icon" href="../../../../student/gameplay/images/favicon.png" type="image/png">
    <title>MathsMax</title>
    <link rel="stylesheet" href="../../../../full.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div id="backButton">
        <a href="../../manageClass.php" class="btn back"><i class="fa fa-backward" aria-hidden="true"></i> Back</a>
    </div>
</body>
</html>