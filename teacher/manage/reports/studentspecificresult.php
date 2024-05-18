<?php
session_start();
include '../../../db.php';
include '../../../functions.php';
tcheck();
sqCheck();
$ClassCode=$_SESSION["classcode"];
$student=$_POST['student'];
$_SESSION['stuID']=$student;
$sql="SELECT account.name, studentclass.classCode, student.HS,student.GP, student.AvS, student.TS FROM account
JOIN student ON account.account_id = student.account_id
JOIN studentclass ON student.student_id = studentclass.student_id
WHERE studentclass.classCode='$ClassCode' AND studentclass.student_id=$student
ORDER BY HS desc";
$leaderboardfetch = $conn->query($sql);
echo '<table>';
echo '<tr>
  <th>Name</th>
  <th>Class Code</th>
  <th>High Score</th>
  <th>Games Played</th>
  <th>Average Score</th>
  <th>Total Score</th>
</tr>';
while($row = $leaderboardfetch->fetch_assoc()) {
  echo '<tr>';
  echo '<td>'.$row['name'] . '</td>';
  echo '<td>'.$row['classCode'] . '</td>';
  echo '<td>'.$row['HS'] . '</td>';
  echo '<td>'.$row['GP'] . '</td>';
  echo '<td>'.$row['AvS' ] . '</td>';
  echo '<td>'.$row['TS'] . '</td>'.'</tr>';}
  

?>

<!DOCTYPE html>
<html>
<script>
function printPage() {
    window.print();
}
</script> 
<head><link rel="icon" href="../../../student/gameplay/images/favicon.png" type="image/png"><style>
  
#print2 {
    background-color:white;
    color: black;
    padding: 12px 20px;
    font-family: 'Times New Roman', Times, serif;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 50px 2px;
    cursor: pointer;
}</style>
    <title>MathsMax</title>
    <link rel="stylesheet" href="../../../full.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div id="backButton">
        <a href="../manageClass.php" class="btn back"><i class="fa fa-backward" aria-hidden="true"></i> Back</a>
    </div>
</body>
</html>
<form action='changepwd/forgot.php' method='POST'>
<p>Change The selected Students Password</p>
<label for='newPassword'>New Password:</label>
<input type='password' id='newPassword' name='newPassword' pattern='(?=.*[A-Z]).{8,}' title="Eight or more Characters and one capital letter"required><br>
<br>
<input type='submit' value='Change Students Password'>
</form>
<br><br><br>
<button id=print2 onclick="printPage()">Print this page</button>