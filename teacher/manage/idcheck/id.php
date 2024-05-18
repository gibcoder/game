<?php
session_start();
include '../../../db.php';
include '../../../functions.php';
tcheck();
sqCheck();


?>
<!DOCTYPE html>
<html>
<head><link rel="icon" href="../../../student/gameplay/images/favicon.png" type="image/png">
    <title>MathsMax</title>
    <link rel="stylesheet" href="../../../full.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            text-align: center;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .content {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .btn {
            display: inline-block;
            transition: 0.3s;
        }

    </style>
</head>
<body>
    <div class="content">
        <?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['code'])) {
    $classCode = $_POST['code'];
    $teacherID = $_SESSION['teacher_id'];


    $sql = "SELECT teacher_id FROM class WHERE classCode = ?";
    if ($idget = $conn->prepare($sql)) {
        $idget->bind_param("i", $classCode);
        $idget->execute();
        $result = $idget->get_result();
        $row = $result->fetch_assoc();

        if ($row && $row['teacher_id'] == $teacherID) {
            $sql2 = "SELECT studentclass.student_id, account.name FROM studentclass  
            JOIN student ON studentclass.student_id = student.student_id
            JOIN account ON student.account_id = account.account_id 
            WHERE classCode = ?";
            if ($idget2 = $conn->prepare($sql2)) {
                $idget2->bind_param("i", $classCode);
                $idget2->execute();
                $result2 = $idget2->get_result();

                if ($result2->num_rows > 0) {
                    while ($row2 = $result2->fetch_assoc()) {
                        echo "Student ID: " . $row2['student_id'] . "   Name: " . $row2['name'] . "<br>";
                    }
                } else {
                    echo "No students found in this class.";
                }
                $idget2->close();
            }
        } else {echo "You do not have permission to view this class";}
    $idget->close();
    }
    $conn->close();
} else {
    echo "Error with request";
}
        ?>
        <div id="backButton">
            <a href="../manageclass.php" class="btn back"><i class="fa fa-backward" aria-hidden="true"></i> Back</a>
        </div>
    </div>
</body>
</html>