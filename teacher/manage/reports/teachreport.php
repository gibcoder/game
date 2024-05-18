<?php
session_start();
include '../../../db.php';
include '../../../functions.php';
tcheck();
sqCheck();

$teach=$_SESSION['teacher_id'];
$sql="SELECT classcode FROM class where teacher_id=?";
$seeclass = $conn->prepare($sql);
$seeclass->bind_param("i", $teach);
$seeclass->execute();
$list = $seeclass->get_result();

echo "<form action='classReport.php' method='POST'>";
echo "<label for='classSelect'>Select a Class:  </label>";
echo "<select id='classSelect' name='classSelect'>";

if ($list->num_rows > 0) {
    while ($row = $list->fetch_assoc()) {
        echo "<option value=".$row['classcode'].">".$row['classcode']."</option>";//htmlcode in the php creating a dropdown menu
    }
} else {
    echo "You Currently have no classes created";//if none-handling
}
echo "</select>";echo"    ";
echo "<input type=submit value=Submit>";  //submit box
echo "</form>";

?>
<!DOCTYPE html>
<html>

<head><link rel="icon" href="../../../student/gameplay/images/favicon.png" type="image/png">

<title>MathsMax</title>
<link rel="stylesheet" href="../../../full.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <div id="backButton">
  <a href="../manageClass.php" class="btn back"><i class="fa fa-backward" aria-hidden="true"></i>  Back
</a>
<br><br>
<?php 
    $error = errorCheck();
    if (!empty($error)): ?>
    <div id="errorPopup" class="errorPopup2">
        <p ><?= $error ?></p>
        <button onclick="document.getElementById('errorPopup').style.display = 'none';">I Understand</button>
    </div><?php endif?>
</div>
