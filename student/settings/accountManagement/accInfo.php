<?php
session_start();
include '../../../db.php';
include '../../../functions.php';
scheck();
sqCheck();


$account_id = $_SESSION['account_id'] ;

if ($account_id) {

    $sql = "SELECT * FROM account WHERE account_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $account_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $accountInfo = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="../../gameplay/images/favicon.png" type="image/png">
<style>
      body {
    padding-top: 50px;
}
    </style>
    <title>MathsMax</title>
    <link rel="stylesheet" href="../../../full.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
<div class="header">
        <a href="../changePass/change.php">Change Password</a>
        <a href="../settings.php">Settings</a>
        <a href="../joinClass/join.php">Join Class</a>
        <a href="../accountManagement/accInfo.php">Account Info</a>
        <div class="account-info">
            <h3 id=jc2>Account Information</h3>
            <table>
            <tr>
                    <th>Account ID:</th>
                    <td><?php echo htmlspecialchars($_SESSION['account_id']); ?></td>
                </tr>
                <tr>
                    <th>Name:</th>
                    <td><?php echo htmlspecialchars($accountInfo['name']); ?></td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td><?php echo htmlspecialchars($accountInfo['email']); ?></td>
                </tr>
                <tr>
                    <th>Account Type:</th>
                    <td><?php echo htmlspecialchars($accountInfo['acc_type']); ?></td>
                </tr>
            </table>
        </div>

</body>
</html>