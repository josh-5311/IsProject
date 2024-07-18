<?php
session_start();
require_once 'db_config.php';

// Fetch pending pickup requests
$pickup_requests = $conn->query("SELECT pr.request_id, pr.user_id, pr.center_id, pr.pickup_date, pr.pickup_time, pr.waste_type, pr.phone, pr.pickup_address, u.username, u.phone FROM pickup_requests pr INNER JOIN users u ON pr.user_id = u.user_id WHERE pr.status = 'pending'");

// Initialize feedback message variable
$feedback_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process approval/rejection
    $request_id = $_POST['request_id'];
    $action = $_POST['action'];

    // Determine status based on action
    $status = ($action == 'approve') ? 'approved' : 'rejected';

    // Prepare SQL statement
    $stmt = $conn->prepare("UPDATE pickup_requests SET status = ? WHERE request_id = ?");
    $stmt->bind_param("si", $status, $request_id);

    // Execute and check if successful
    if ($stmt->execute()) {
        $feedback_message = "Request status updated successfully.";
    } else {
        $feedback_message = "Error updating request status: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Approve Requests - Green Gear</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="approve-requests-body">
    <div class="approve-requests-container">
        <h2>Approve E-waste Pickup Requests</h2>
        
        <!-- Feedback message -->
        <?php if (!empty($feedback_message)): ?>
            <div class="feedback-message">
                <?php echo htmlspecialchars($feedback_message); ?>
            </div>
        <?php endif; ?>

        <!-- Pending Pickup Requests -->
        <?php if ($pickup_requests->num_rows > 0): ?>
            <table class="pickup-requests-table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Center</th>
                        <th>Pickup Date</th>
                        <th>Pickup Time</th>
                        <th>Waste Type</th>
                        <th>User Phone</th>
                        <th>Pickup Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $pickup_requests->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['username']); ?></td>
                            <td><?php echo htmlspecialchars($row['center_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['pickup_date']); ?></td>
                            <td><?php echo htmlspecialchars($row['pickup_time']); ?></td>
                            <td><?php echo htmlspecialchars($row['waste_type']); ?></td>
                            <td><?php echo htmlspecialchars($row['phone']); ?></td>
                            <td><?php echo htmlspecialchars($row['pickup_address']); ?></td>
                            <td>
                                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="requests-action-form">
                                    <input type="hidden" name="request_id" value="<?php echo htmlspecialchars($row['request_id']); ?>">
                                    <button type="submit" name="action" value="approve" class="approve-requests-button">Approve</button>
                                    <button type="submit" name="action" value="reject" class="reject-requests-button">Reject</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No pending pickup requests.</p>
        <?php endif; ?>
    </div>
</body>
</html>