<?php
session_start();
include '../../../db.php';
include '../../../functions.php';
tcheck();
sqCheck();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $classCodeToDelete = $_POST['codedel'];
    $teacherId = $_SESSION['teacher_id'];

    $checkSql = "SELECT teacher_id FROM class WHERE classCode = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("i", $classCodeToDelete);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if ($row['teacher_id'] == $teacherId) {
            $deleteSql = "DELETE FROM class WHERE classCode = ?";
            $deleteStmt = $conn->prepare($deleteSql);
            $deleteStmt->bind_param("i", $classCodeToDelete);
            $deleteStmt->execute();

            if ($deleteStmt->affected_rows > 0) {
                header("Location: ../manageclass.php?status=SuccessfulDelete");
            } else {
                header("Location: ../manageclass.php?status=NotExist");
            }
        } else {
            header("Location: ../manageclass.php?status=NotAuthorised");
        }
    } else {
        header("Location: ../manageclass.php?status=NotFound");
    }
} else {
    header("Location: ../manageclass.php?status=notMainPage");
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="../../../student/gameplay/images/favicon.png" type="image/png"> 
    
    <title>MathsMax</title>
    <link rel="stylesheet" href="../../../full.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            text-align:center;
            padding: 20px;
            font-size:30;
        }

    </style>
</head>
<body>

        <div id="backButton">
            <a href="../manageclass.php" class="btn back"><i class="fa fa-backward" aria-hidden="true"></i> Back</a>
        </div>
    </div>
</body>
</html>