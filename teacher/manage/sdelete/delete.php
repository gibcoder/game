<?php
session_start();
include '../../../db.php';
include '../../../functions.php';
tcheck();
sqCheck();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $studentID = $_POST['SID'];
    $classCode = $_POST['code'];
    $teacherID = $_SESSION['teacher_id'];
    $sql2 = "";
    $sql = "SELECT teacher_id FROM class WHERE classCode = ?";
    if ($teach = $conn->prepare($sql)) {
        $teach->bind_param("i", $classCode);
        $teach->execute();
        $result = $teach->get_result();
        $row = $result->fetch_assoc();
        if ($row && $row['teacher_id'] == $teacherID) {
            $sql2 = "DELETE FROM studentclass WHERE student_id = ? AND classCode = ?";
            if ($delete = $conn->prepare($sql2)) {
                $delete->bind_param("ii", $studentID, $classCode);
                $delete->execute();
                if ($delete->affected_rows > 0) {
                    header("Location: ../manageclass.php?status=deletion=success");
                } else {
                    header("Location:../manageclass.php?status=studentnotfound");
                }
                $delete->close();
            } else {
                header("Location: ../manageClass.php?status=sqlerror");
            }
        } else {
            header("Location: ../manageclass.php?status=unauthorized");
        }
        $teach->close();}
        else {
            header("Location: ../manageClass.php?status=sqlerror");}}
     else {
        header("Location: ../manageClass.php?status=invalidrequest");}
?>

<!DOCTYPE html>
<html>
<head><link rel="icon" href="../../../student/gameplay/images/favicon.png" type="image/png">
<!--sets title and references the css style sheet to style my page-->
