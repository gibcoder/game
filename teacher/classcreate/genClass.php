<?php

session_start();
include '../../db.php';
include '../../functions.php';
tcheck();//tested//maybe add the function from functions.php and create a simler easier module
sqCheck();
?>
<!DOCTYPE html>
<html>
<style>
.centered-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }
        .gen {
            background-color: #00cc00;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 18px;
            border-radius: 8px;
            border: none;
            transition: background-color 0.3s ease;
        }
        .gen:hover {
            background-color: #00b200;
        }

</style>

<head>

<!--sets title and references the css style sheet to style my page-->
<title>MathsMax</title>
<h1>Clicking the button below will genrate a class, please understand this before clicking.<br><br></h1>
<link rel="stylesheet" href="../../full.css">
    <!--links icon style sheet w3schools.com https://www.w3schools.com/howto/howto_css_icon_buttons.asp/fontawesome.com v4.7-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="icon" href="../../student/gameplay/images/favicon.png" type="image/png">
</head>
<body>
<div id="backButton">
  <a href="../teacherpage.php" class="btn back"><i class="fa fa-backward" aria-hidden="true"></i>  Back
</a>
</div>
<div class="centered-container">
        <a class="gen" href="createClass.php">Generate Class</a>
    </div>
</body>
</html>