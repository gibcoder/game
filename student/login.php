<?php
session_start();

include '../db.php';
include '../functions.php';
sqCheck();

//defensive programming ------clear naming convention
if ($_SERVER['REQUEST_METHOD'] === 'POST') {// so that if coming back or skipping to this it wont have to re insert any data so this section will be skipped, so it will not break the code
  $Name=$_POST["Name"];
  $Email=$_POST["Email"];
  $hashedPassword = password_hash($_POST["Password"], PASSWORD_BCRYPT);
//example of creating my own hash
//function myhash($input) {
  //$salt = "Yrf67"; 
  //$length = strlen($input);
  //$hash = '';
  //for ($i = 0; $i < $length; $i++) {
      //$char = substr($input, $i, 1);//changes hash based on characters position
      //$ascii = ord($char) + $i;
      //$hash .= chr(($ascii % 56) + 32);//used exampl
  //}
  //return md5($salt . $hash);//returns a salt to make it  more complex
//}

  $SQ=$_POST["SQ"];
  $SQA=$_POST["SQA"];
$type='student';


$checkEmail = $conn->prepare("SELECT Email FROM account WHERE Email = ?");
$checkEmail->bind_param("s", $Email);
$checkEmail->execute();
$checkEmail->store_result();
if ($checkEmail->num_rows > 0) {
    header("Location: LorR.php?status=emailInUse");
} else {
$insertion=$conn->prepare("insert into account(Name,Email,Password,SQ,SQA,acc_type)
        values(?,?,?,?,?,?)");
        $insertion->bind_param("ssssss",$Name,$Email,$hashedPassword,$SQ,$SQA,$type);//ssssss binds them all as string data types
        $insertion->execute();
    //this adds created account to student id table
        $accountID = $insertion->insert_id;
        $student = $conn->prepare("INSERT INTO student(account_id) VALUES (?)");//prepare to send data seperatly so that hacker cant get inside easily/inject
        $student->bind_param("i", $accountID);//bind param keeps the parameter binded which is very helpful/ read about in php my admoin
        if($student->execute())echo"Registration Successful";
        else echo "Registration Unsuccessful" ;
      $student->close();
      $insertion->close();
} }






//https://www.php.net/manual/en/function.password-hash.php helps
//need to fix hash verification
?>

<!DOCTYPE html>
<html>

<head>
  <style>.password-container {
    display: flex;
    align-items: center;
}
.password-container input[type=password] {
    margin-right: 5px;
}
.password-container button {
    padding: 5px 10px;
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
<link rel="icon" href="gameplay/images/favicon.png" type="image/png">
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
    <form id="register" class="inputs" action="studentpage.php" method="POST">
            <!--creating input boxes-->

 
<br><br>
<div id="backButton">
  <a href="LorR.php" class="btn back"><i class="fa fa-backward" aria-hidden="true"></i>  Back
</a>
</div>


    <!--creating input boxes-->
    <label for="Email">Email:</label>
        <input type="email" class="inputs" id="email" name="Email" required>
    <label for="Password">Password:</label>
    <div class="password-container">
        <input type="password" class="inputs" id="password" name="Password" pattern="(?=.*[A-Z]).{8,}" title="Eight or more Characters and one capital letter" required>
         <button type="button" onclick="toggleVisibility('password')">Show/Hide</button>   <br>
      </div><br> <input type="submit">
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