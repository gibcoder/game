<?php
session_start();

include '../db.php';
include '../functions.php';
sqCheck();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $Name=$_POST["Name"];
  $Email=$_POST["Email"];
  $hashedPassword = password_hash($_POST["Password"], PASSWORD_BCRYPT);
  $SQ=$_POST["SQ"];
  $SQA=$_POST["SQA"];
  $pass=$_POST["Password"];
$type='teacher';
//$blank=placeholder cos couldnt think of good name for variable

 
$checkEmail = $conn->prepare("SELECT Email FROM account WHERE Email = ?");
$checkEmail->bind_param("s", $Email);
$checkEmail->execute();
$checkEmail->store_result();
if ($checkEmail->num_rows > 0) {
    header("Location: teachreg.php?status=emailInUse");
} else {
$blank=$conn->prepare("insert into account(Name,Email,Password,SQ,SQA,acc_type)
    values(?,?,?,?,?,?)");
    $blank->bind_param("ssssss",$Name,$Email,$hashedPassword,$SQ,$SQA,$type);
    //show you can hash anyway--
    $blank->execute();
    //echo"registered succesfully";
    //this adds created account to teacher id table
    $accountID = $blank->insert_id;
    $Teacher = $conn->prepare("INSERT INTO teacher(account_id) VALUES (?)");//prepare to send data seperatly so that hacker cant get inside easily/inject
    $Teacher->bind_param("i", $accountID);//bind param keeps the parameter binded which is very helpful/ read about in php my admoin
    if($Teacher->execute())echo"Registration Successful";
    else echo "Registration Unsuccessful" ;


  $Teacher->close();
  $blank->close();
} }




//https://www.php.net/manual/en/function.password-hash.php helps
//need to fix hash verification
?>

<!DOCTYPE html>
<html>

<head>
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
<style>.password-container {
    display: flex;
    align-items: center;
}
.password-container input[type=password] {
    margin-right: 5px;
}
.password-container button {
    padding: 5px 10px;
}</style>
<link rel="icon" href="../student/gameplay/images/favicon.png" type="image/png">
<!--sets title and references the css style sheet to style my page-->
<title>MathsMax</title>
<link rel="stylesheet" href="../full.css">
 <!--links icon style sheet w3schools.com https://www.w3schools.com/howto/howto_css_icon_buttons.asp/fontawesome.com v4.7-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<script src="LorR.js"></script>
<h1>MathsMax!</h1>
<h2> Welcome Back! </h2>
<!--creating a login/register page-->
<div class="signup">
    <div class="form">
        <div class=subform2>
<!--adding buttons for registering and text to display what to do, and a teacher switch-->
        
            <p id="reg1"> Login Below</p>
    <form id="register" class="inputs" action="teacherpage.php" method="POST">

 
<br><br>
<div id="backButton">
  <a href="teachreg.php" class="btn back"><i class="fa fa-backward" aria-hidden="true"></i>  Back
</a>
</div>

    <!--creating input boxes-->
    <label for="Email">Email:</label>
        <input type="email" class="inputs" id="email" name="Email" required>
    <label for="Password">Password:</label>
    <div class="password-container">
        <input type="password" class="inputs" id="password" name="Password" pattern="(?=.*[A-Z]).{8,}" title="Eight or more Characters and one capital letter" required><br>
        <button type="button" onclick="toggleVisibility('password')">Show/Hide</button></div> <br>
        <input type="submit">
</form>

    </div>
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
    </div>
</div>

</body>




</html>