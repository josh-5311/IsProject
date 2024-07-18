<?php
session_start();
require_once 'db_config.php';

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Get the user ID from the session
$username = $_SESSION['username'];
$stmt = $conn->prepare("SELECT user_id FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($user_id);
$stmt->fetch();
$stmt->close();

// Fetch the pickup requests for the logged-in user
$stmt = $conn->prepare("SELECT pr.request_id, pr.pickup_date, pr.pickup_time, pr.waste_type, pr.status, l.center_name 
                        FROM pickup_requests pr 
                        JOIN centers l ON pr.center_id = l.center_id 
                        WHERE pr.user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pickup History - Green Gear</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="pickup-history-body">
    <div class="pickup-history-container">
        <h2>Pickup History</h2>
        <!-- Pickup History Table -->
        <table class="pickup-history-table">
            <thead>
                <tr>
                    <th>Request ID</th>
                    <th>Center</th>
                    <th>Pickup Date</th>
                    <th>Pickup Time</th>
                    <th>Waste Type</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['request_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['center_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['pickup_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['pickup_time']); ?></td>
                        <td><?php echo htmlspecialchars($row['waste_type']); ?></td>
                        <td><?php echo htmlspecialchars($row['status']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
