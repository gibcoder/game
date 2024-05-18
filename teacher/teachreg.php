<?php
  include '../functions.php';
?>
<!DOCTYPE html>
<html>

<head>
<link rel="icon" href="../student/gameplay/images/favicon.png" type="image/png">
<title>MathsMax</title>
<link rel="stylesheet" href="../full.css">
 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
        
</head>
<body>
<script src="LorR.js"></script>
 
<h1>MathsAdventure!</h1>
<h2> Login Or Register? </h2>
<!--creating a login/register page-->
<div class="signup">
    <div class="form">
        <div class=subform>

            <a type="button" class="button reg" href="loginteach.php">Already got an account?</a>
            <p id="reg1"> Register Below</p>
            
<style>
.password-container label {
    margin-right: 10px;  
}
</style> 
<script>
        function toggleVisibility(id) {
            var x = document.getElementById(id);
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script> 
        </div>
        <!--to switch between pages so teacher and student have differnet pages-->
        <script src="LorR.js"></script>
        <form id="register" class="inputs" action="loginteach.php" method="post">
            <!--creating input boxes--><!--add the change page to have 2 logins-->
  
            
            <label for="Name">Full Name:</label>
            <input type="text" class="inputs" id="name" name="Name" required>

            <label for="Email">Email:</label>
            <input type="email" class="inputs" id="email" name="Email" required>
            <div class="password-container">
            <label for="Password">Password:</label>
            <input type="password" class="inputs" id="password" name="Password" pattern="(?=.*[A-Z]).{8,}" title="Eight or more Characters and one capital letter" required>
            <small id="pwd">8 characters minimum,1 capital minimum.</small><br>
            <button type="button" onclick="toggleVisibility('password')">Show/Hide</button>
            </div>
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

            <input type="submit">
        </form>

    </div>
    
    </div>
    <a href="../tors.php" class="btn back"><i class="fa fa-backward" aria-hidden="true"></i> Back</a>
    <?php 
    $error = errorCheck();
    if (!empty($error)): ?>
    <div id="errorPopup" class="errorPopup2">
        <p ><?= $error ?></p>
        <button onclick="document.getElementById('errorPopup').style.display = 'none';">I Understand</button>
    </div><?php endif?>
</body>
</html>