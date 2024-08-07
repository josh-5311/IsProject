<?php
session_start();

if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Green Gear</title>
    <link rel="stylesheet" href="styles.css">
</head>
<<<<<<< HEAD
<body class="main">
=======
<body>
>>>>>>> 5f639c6bdd0ae8501e593ced01ca22f9d356f59a
    <div class="user-dashboard-container">
        <div class="user-welcome-message">
            <h1>Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
        </div>
        <div class="user-operations">
            <div class="user-operation-container">
                <div class="icon">&#128205;</div>
                <h3>Center Locators</h3>
<<<<<<< HEAD
                <a href="center_locators.php">View Centers</a>
=======
                <a href="center_locators.html">View Centers</a>
>>>>>>> 5f639c6bdd0ae8501e593ced01ca22f9d356f59a
            </div>
            <div class="user-operation-container">
                <div class="icon">&#128465;</div>
                <h3>Request Pickup</h3>
<<<<<<< HEAD
                <a href="request_pickup.php">Request Pickup</a>
=======
                <a href="request_pickup.html">Request Pickup</a>
>>>>>>> 5f639c6bdd0ae8501e593ced01ca22f9d356f59a
            </div>
            <div class="user-operation-container">
                <div class="icon">&#128211;</div>
                <h3>Public Awareness</h3>
<<<<<<< HEAD
                <a href="public_awareness.php">Learn More</a>
=======
                <a href="public_awareness.html">Learn More</a>
>>>>>>> 5f639c6bdd0ae8501e593ced01ca22f9d356f59a
            </div>
            <div class="user-operation-container">
                <div class="icon">&#128100;</div>
                <h3>User Profile</h3>
<<<<<<< HEAD
                <a href="user_profile.php">View Profile</a>
=======
                <a href="user_profile.html">View Profile</a>
>>>>>>> 5f639c6bdd0ae8501e593ced01ca22f9d356f59a
            </div>
            <div class="user-operation-container">
                <div class="icon">&#128184;</div>
                <h3>Pickup History</h3>
<<<<<<< HEAD
                <a href="pickup_history.php">View History</a>
=======
                <a href="pickup_history.html">View History</a>
>>>>>>> 5f639c6bdd0ae8501e593ced01ca22f9d356f59a
            </div>
            <div class="user-operation-container">
                <div class="icon">&#11088;</div>
                <h3>Rate Service</h3>
<<<<<<< HEAD
                <a href="rate_service.php">Rate Service</a>
=======
                <a href="rate_service.html">Rate Service</a>
>>>>>>> 5f639c6bdd0ae8501e593ced01ca22f9d356f59a
            </div>
            <div class="user-operation-container">
                <div class="icon">&#128682;</div>
                <h3>Log Out</h3>
                <a href="logout.php">Log Out</a>
            </div>
        </div>
    </div>
</body>
</html>
