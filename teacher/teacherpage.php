<?php
session_start(); 
include '../db.php';
include '../functions.php';

sqCheck();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Email =$_POST['Email'];
    $Password = $_POST['Password'];

//echo "email: " . $Email//testing using to check why hash wasnt worjing
//echo "password: " . $Password
//https://www.php.net/manual/en/function.password-hash.php
//https://www.php.net/manual/en/function.password-hash.php

//$hashed=password_hash($_POST["Password"], PASSWORD_BCRYPT);
    $sql = "SELECT * FROM account WHERE email=?";
    $efetch = $conn->prepare($sql);
    $efetch->bind_param("s", $Email);
    $efetch->execute();
    $ans = $efetch->get_result();
    $row = $ans->fetch_assoc();


    if ($row && password_verify($Password, $row['password'])) {
        if ($row['acc_type'] === 'student') {
            header("Location: loginteach.php?status=Incorrect account type");
            exit();
        }
        $_SESSION['Email'] = $row['email'];
        $_SESSION['Name'] = $row['name'];
        $_SESSION['account_id'] = $row['account_id'];
        $_SESSION['acc_type']=$row['acc_type'];

       $newLoginCount = $row['login_count'] + 1;
       $updateLogSQL = "UPDATE account SET login_count=? WHERE email=?";
       $updateLogCount = $conn->prepare($updateLogSQL);
       $updateLogCount->bind_param("is", $newLoginCount, $Email);
       $updateLogCount->execute();

       if ($newLoginCount % 20 === 0) {
         header("Location:../check20.php");
           exit();
       }
        header("Location: teacherpage.php");
        exit();
    } else {
        header("Location: loginteach.php?status=Incorrect Email or password");
     exit();
    }
}////////////////add account types to reject oppisites

//getting the teacherid from the teacher account andd setting it to session so that the create class insertion workss
if (isset($_SESSION['account_id'])) {
    $id = $_SESSION['account_id'];
    $sql2 = "SELECT * FROM teacher WHERE account_id = ?";
    $idfetch = $conn->prepare($sql2);//prepares the query
    $idfetch->bind_param("i", $id);//binds parameters
    if ($idfetch->execute()) {//if $idfetch works
        $idnow = $idfetch->get_result();//gets result
        if ($row = $idnow->fetch_assoc()) {////if the same then set it as so
            $_SESSION['teacher_id'] = $row['teacher_id'];
        }
    }
    $idfetch->close();//close so statement released
    $conn->close();
}

tcheck();

/*if this then tis else login etc*/
//

?>
<!DOCTYPE html>
<html>

<head>

<link rel="icon" href="../student/gameplay/images/favicon.png" type="image/png">
<title>MathsMax</title>
<link rel="stylesheet" href="../full.css">
    <!--links icon style sheet w3schools.com https://www.w3schools.com/howto/howto_css_icon_buttons.asp/fontawesome.com v4.7-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</head>
<body>
<style>body {
    font-family: 'Arial', sans-serif;
    background-color: #f0f0f0;
    text-align: center;
    padding: 20px;
}

.welcome-message h1 {
    color: #333;
    font-size: 2.5em;
    margin-bottom: 30px;
}
.button-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 15px;
}
/*https://louisem.com/419029/green-hex-codes */
.manage, .create {
    left: 10px;
    background-color: #00cc00;
    border: none;
    color: white;
    padding: 15px 32px;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.2s;
}

.manage:hover, .create:hover {
    background-color: #009900;
    transform: scale(1.05); 
}
.manage {
    top: 10px;
}
.create {
    top: 60px;}


</style>
<h1>MathsMax!</h1>
<div class="welcome-message">
        <h1><br><br><br><br>Hello, Teacher!</h1>
    </div>
    <div class="button-container">
        <a class="btn create" href="classcreate/genClass.php">CREATE CLASS</a>
        <a class="btn manage"  href="manage/manageClass.php">MANAGE CLASSES</a>
        <a href="loginteach.php" class="btn back"><i class="fa fa-backward" aria-hidden="true"></i> Back</a>
        <a class="btn leaderboard" href="tsettings/tsettings.php"><i class="fa fa-cog" aria-hidden="true"></i> SETTINGS</a>
    </div>
    
    <?php 
    $error = errorCheck();
    if (!empty($error)): ?>
    <div id="errorPopup" class="errorPopup2">
        <p ><?= $error ?></p>
        <button onclick="document.getElementById('errorPopup').style.display = 'none';">I Understand</button>
    </div><?php endif?>
</div>
