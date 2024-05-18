<!DOCTYPE html>
<html>
  
<?php
  include 'functions.php';
?>
<head>
<link rel="icon" href="student/gameplay/images/favicon.png" type="image/png">
<title>MathsMax</title>
    <link rel="stylesheet" href="full.css">
    <!--links icon style sheet w3schools.com https://www.w3schools.com/howto/howto_css_icon_buttons.asp/fontawesome.com v4.7-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
body {
 

    text-align: center;
    padding: 50px;
}
h1 {
    color: red;
    font-size: 2.5em;
}
h2 {
    color: black;
    font-size: 1.5em;
    margin-bottom: 40px;
}
</style>
</head>
<body>
<h1>MathsMax!</h1>
<h2>Choose if you're a student or a teacher</h2>
    <div class="tors">
        <a class=mybutton1 type="button" href="teacher/teachreg.php"><div>Teacher</div></a>
        <a class=mybutton2 type="button" href="student/lorr.php"><div>Student</div></a>
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