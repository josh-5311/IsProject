<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Green Gear</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="main">
    <div class="dashboard-container">
        <div class="welcome-message">
            
        </div>
        <div class="admin-operations">
            <div class="operation-container">
                <div class="icon">&#128736;</div>
                <h3>Manage Centers</h3>
                <a href="manage_centers.php">Go to Manage Centers</a>
            </div>
            <div class="operation-container">
                <div class="icon">&#128505;</div>
                <h3>Approve Requests</h3>
                <a href="approve_requests.php">Go to Approve Requests</a>
            </div>
            <div class="operation-container">
                <div class="icon">&#128200;</div>
                <h3>Generate Reports</h3>
                <a href="generate_reports.php">Go to Generate Reports</a>
            </div>
            <div class="operation-container">
                <div class="icon">&#128274;</div>
                <h3>Log Out</h3>
                <a href="logout.php">Log Out</a>
            </div>
        </div>
    </div>
</body>
</html>
