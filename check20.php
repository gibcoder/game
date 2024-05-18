<?php
session_start();
include 'functions.php';
include 'db.php';
if (isset($_SESSION['account_id'])){
$_SESSION['needsCheck'] = true;}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selected = $_POST['SQ'];
    $answer = $_POST['SQA'];
    $accountId = $_SESSION['account_id'];
    
    $sql = "SELECT SQ, SQA FROM account WHERE account_id=?";
    $sqGet = $conn->prepare($sql);
    $sqGet->bind_param("i", $accountId);
    $sqGet->execute();
    $result = $sqGet->get_result();
    $row = $result->fetch_assoc();

    if ($row['SQ'] == $selected && strtolower($row['SQA']) == strtolower($answer)) {    
        if ($_SESSION['acc_type'] == 'teacher') {
            unset($_SESSION['needsCheck']);
            header("Location: teacher/teacherpage.php");
}       else {
            unset($_SESSION['needsCheck']);
            header("Location: student/studentpage.php");
}
    } else {
        header("Location: check20.php?error=Incorrect, try again");
        exit();
    }
}

?>
<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
    
    <title>MathsMax</title>
    <link rel="stylesheet" href="full.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
display: flex;
justify-content: center;
align-items: center;
height: 100vh;
}
.formbox {/*whole box*/ 
background: white;
padding: 35px;
border-radius: 8px;
width: 300px;
}
.formbox label, .formbox select, .formbox input {/*inputs selects and label*/ 
width: 100%;
margin-bottom: 10px;
margin-left: -2px;
}
.formbox input[type="submit"] {/*submit button*/ 
background-color: green;
color: white;
cursor: pointer;/*makes it a hand*/ 
}

</style>
</head>
<body>

<div class="formbox">
    <form action="check20.php" method='POST'>
        <label for="SQ">Security Question:</label>
        <select class="inputs" id="sq" name="SQ" required>
      <option value="1">What was the name of your first pet?</option>
      <option value="2">Whats the First School you attended called?</option>
      <option value="3">Whats Your mothers maiden name?</option>
      <option value="4">What is your fathers middle name?</option>
      <option value="5">What is the make of your mothers first car?</option>
      <option value="6">What is the name of the place you were born?</option>
      <option value="7">What is the name of your first stuffed animal?</option>
        </select>
        <label for="SQA">Security Question Answer:</label>
        <input type="text" class="inputs" id="sqa" name="SQA" required>
        <input type="submit" value="Submit">
    </form>
</div>

</body>
</html>

