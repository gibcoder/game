<?php

function tcheck(){
  if ($_SESSION['acc_type']!='teacher'){
    header("Location: /game/TorS.php?status=Incorrect account type or not logged in");
    exit();
  }//made for the login specifficaly but on all just to double checkin case someone had ealier mad an  account with a teacher and student id before it was fully coded not to let that happen
}
function scheck() {
  if ($_SESSION['acc_type'] != 'student') {
      header("Location: /game/TorS.php?status=Incorrect account type or not logged in");
      exit();
  }
}

function aToS($conn) {
  $account_id = $_SESSION["account_id"];
  $sql = "SELECT student_id FROM student WHERE account_id = ?";
  $temp = $conn->prepare($sql);
  $temp->bind_param("i", $account_id);
  $temp->execute();
  $result = $temp->get_result();
  $row = $result->fetch_assoc();
  return $row;}


function sqCheck(){
  if (isset($_SESSION['needsCheck']) && $_SESSION['needsCheck'] === true) {
    header("Location: /game/check20.php");
    exit();
}
}
function errorCheck(){
$error = "";
if (isset($_GET['status'])) {
    switch ($_GET['status']) {
        case 'WRONG_SECURITY_ANSWER':
            $error = "Wrong security answer provided.";
            break;
        case 'Incorrect Email or password':
              $error = "Incorrect email or password.";
              break;
        case 'Incorrect account type or not logged in':
                $error = "Incorrect account type used or not logged in.";
                break;
        case 'WRONG_SECURITY_QUESTION':
            $error = "Wrong security question selected.";
            break;
        case 'Incorrect account type':
            $error = "Wrong account type used.";
            break;
        case 'NOTUPDATED/WRONGPASSWORD';
            $error = "Wrong Password Submitted.";
            break;
        case 'NOTUPDATED/ERROR';
            $error = "Error Updating Password.";
            break;
        case 'UPDATED/Successful';
            $error = "Successfully Updated Password.";
            break;
        case 'class_not_found';
            $error = "Class Not Found.";
            break;  
        case 'joined_success';
            $error = "Successfully Joined Class.";
            break;   
        case 'already_joined';
            $error = "You are already enrolled in this class.";
            break;  
        case 'SuccessfulDelete';
            $error = "Successfully deleted class.";
            break; 
        case 'NotExist';
            $error = "Class does not exist.";
            break;  
        case 'NotFound';
            $error = "Class was not found.";
            break;  
        case 'NotAuthorised';
            $error = "You are Not authorised to delete this class.";
            break;  
        case 'notMainPage';
            $error = "Please enter a classcode via the submission area on this page.";
            break;      
        case 'deletion=success';
            $error = "Succesfully deleted student.";
            break;      
        case 'sqlerror';
            $error = "SQL Error, please try again.";
            break;      
        case 'unauthorized';
            $error = "You are not authorized to delete student from this class, or class doesnt exist.";
            break;      
        case 'invalidrequest';
            $error = "Request is invalid.";
            break;      
        case 'studentnotfound';
            $error = "Student was no found in that class, check student id and try again.";
            break;  
        case 'grapherror';
            $error = "No students in the class.";
            break;    
        case 'emailInUse';
            $error = "Email is already in use.";
            break;  
            
    

    }
}
return $error;
}