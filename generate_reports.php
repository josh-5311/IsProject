<?php
session_start();
require_once 'db_config.php';

// Fetch all pickup requests ordered by request_id in ascending order
$pickup_requests = $conn->query("SELECT pr.request_id, pr.user_id, pr.center_id, pr.pickup_date, pr.pickup_time, pr.waste_type, pr.phone, pr.pickup_address, pr.status, u.username, u.phone FROM pickup_requests pr INNER JOIN users u ON pr.user_id = u.user_id ORDER BY pr.request_id ASC");

// Calculate total approved and rejected requests
$total_approved = $conn->query("SELECT COUNT(*) AS total FROM pickup_requests WHERE status = 'approved'")->fetch_assoc()['total'];
$total_rejected = $conn->query("SELECT COUNT(*) AS total FROM pickup_requests WHERE status = 'rejected'")->fetch_assoc()['total'];

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Generate Reports - Green Gear</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="generate-reports-body">
    <div class="generate-reports-container">
        <h2>E-waste Pickup Requests Report</h2>
        
        <!-- Display totals -->
        <div class="report-totals">
            <p>Total Approved Requests: <?php echo htmlspecialchars($total_approved); ?></p>
            <p>Total Rejected Requests: <?php echo htmlspecialchars($total_rejected); ?></p>
        </div>

        <!-- Pickup Requests Table -->
        <?php if ($pickup_requests->num_rows > 0): ?>
            <table class="pickup-requests-table">
                <thead>
                    <tr>
                        <th>Request ID</th>
                        <th>User</th>
                        <th>Phone</th>
                        <th>Center</th>
                        <th>Pickup Date</th>
                        <th>Pickup Time</th>
                        <th>Waste Type</th>
                        <th>Pickup Address</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $pickup_requests->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['request_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['username']); ?></td>
                            <td><?php echo htmlspecialchars($row['phone']); ?></td>
                            <td><?php echo htmlspecialchars($row['center_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['pickup_date']); ?></td>
                            <td><?php echo htmlspecialchars($row['pickup_time']); ?></td>
                            <td><?php echo htmlspecialchars($row['waste_type']); ?></td>
                            <td><?php echo htmlspecialchars($row['pickup_address']); ?></td>
                            <td><?php echo htmlspecialchars($row['status']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No pickup requests found.</p>
        <?php endif; ?>
    </div>
</body>
</html>