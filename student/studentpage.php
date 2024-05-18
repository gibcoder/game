<?php
session_start(); 
include '../db.php';
include '../functions.php';
sqCheck();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {//only accessible if posting a form
$Email = $_POST['Email'];
$Password = $_POST['Password'];
//https://www.php.net/manual/en/function.password-hash.php

//https://www.w3schools.com/php/func_mysqli_fetch_assoc.asp - how i learnt about the use of the object oriented style of the -> arrows and//https://www.w3schools.com/php/func_mysqli_prepare.asp

$sql = "SELECT * FROM account WHERE email=?";
$efetch = $conn->prepare($sql);
$efetch->bind_param("s", $Email);
$efetch->execute();
$ans = $efetch->get_result();
$row = $ans->fetch_assoc();


    if ($row && password_verify($Password, $row['password'])) {//if the password verify returns true and the row has a result then executes code below
      if ($row['acc_type'] === 'teacher') {
        header("Location: login.php?status=Incorrect account type");
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
        header("Location: ../check20.php");
          exit();
      }
      header("Location: studentpage.php");
      exit();
  } else {
      header("Location: login.php?status=Incorrect Email or password");
   exit();
  }
}
//getting the stduentid from the student account andd setting it to session so that the create class insertion workss
if (isset($_SESSION['account_id'])) {
    $id = $_SESSION['account_id'];
    $sql2 = "SELECT * FROM student WHERE account_id = ?";
    $idfetch = $conn->prepare($sql2);//prepares the query
    $idfetch->bind_param("i", $id);//binds parameters
    if ($idfetch->execute()) {//does the query
        $idnow = $idfetch->get_result();//gets result
        if ($row = $idnow->fetch_assoc()) {////if the same then set it as so
            $_SESSION['student_id'] = $row['student_id'];
        }
    }
    $idfetch->close();//clears variable
}
scheck()

?>
<!DOCTYPE html>
<html>

<head>
<link rel="icon" href="gameplay/images/favicon.png" type="image/png">
<!--sets title and references the css style sheet to style my page-->
<title id=main>MathsMax</title>
<link rel="stylesheet" href="../full.css">
    <!--links icon style sheet w3schools.com https://www.w3schools.com/howto/howto_css_icon_buttons.asp/fontawesome.com v4.7-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>

body {
    font-family: 'Arial', sans-serif;
    background: linear-gradient(to right, #b3d9ff 0%, #80bfff 100%);
    color: #333;
    text-align: center;
    padding: 20px;
}
h1 {
    color: red;
    margin-bottom: 40px;
    border-radius: 5px;
}
.btn:hover {
    background-color: #0056b3;
}
#backButton, #leadButton, #settingsButton, #gameButton {margin-top: 20px;}
</style>

</head>
<body>
  <!--setting up title and what the page will display-->  
    <h1>MathsMax!</h1>


 <!--creating the buttons and referencing where they will take when clicked and giving an icon-->
<div id="gameButton">
<a class="btn play" href="gameplay/selection.php">PLAY GAME</a>
</div>
<div id="settingsButton">
<a class="btn settings" href="settings/settings.php"><i class="fa fa-cog" aria-hidden="true"></i>SETTINGS
</a>
</div>
<div id="backButton">
  <a href="login.php" class="btn back"><i class="fa fa-backward" aria-hidden="true"></i>  Back
</a>
</div>
<div id="leadButton">
  <a href="leaderboard/leaderboard.php" class="btn leaderboard"><i class="fa fa-trophy" aria-hidden="true"></i>Leaderboard
  </a>
</div>
<?php
$error = errorCheck();
    if (!empty($error)): ?>
    <div id="errorPopup" class="errorPopup2">
        <p ><?= $error ?></p>
        <button onclick="document.getElementById('errorPopup').style.display = 'none';">I Understand</button>
    </div><?php endif?>
</div>

</body>
</html>
