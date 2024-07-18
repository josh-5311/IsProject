<?php
session_start();
require_once 'db_config.php';

// Fetch centers from the database
$centers = $conn->query("SELECT center_id, center_name FROM centers");

// Initialize feedback message variable
$feedback_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process pickup request
    $center_id = $_POST['center_id'];
    $pickup_date = $_POST['pickup_date'];
    $pickup_time = $_POST['pickup_time'];
    $waste_type = $_POST['waste_type'];
    $pickup_address = $_POST['pickup_address'];
    $user_id = $_SESSION['user_id']; // Assuming user is logged in and user_id is stored in session

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO pickup_requests (user_id, center_id, pickup_date, pickup_time, waste_type, pickup_address) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iissss", $user_id, $center_id, $pickup_date, $pickup_time, $waste_type, $pickup_address);

    // Execute and check if successful
    if ($stmt->execute()) {
        $feedback_message = "Pickup request submitted successfully.";
    } else {
        $feedback_message = "Error submitting pickup request: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Request Pickup - Green Gear</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="request-pickup-body">
    <div class="request-pickup-container">
        <h2>Request E-waste Pickup</h2>
        
        <!-- Feedback message -->
        <?php if (!empty($feedback_message)): ?>
            <div class="feedback-message">
                <?php echo htmlspecialchars($feedback_message); ?>
            </div>
        <?php endif; ?>

        <!-- Request Pickup Form -->
        <form class="form-request-pickup" method="POST" action="request_pickup.php">
            <label for="center_id">Select Center:</label>
            <select id="center_id" name="center_id" required>
                <option value="">Select Center</option>
                <?php while ($row = $centers->fetch_assoc()): ?>
                    <option value="<?php echo htmlspecialchars($row['center_id']); ?>">
                        <?php echo htmlspecialchars($row['center_name']); ?>
                    </option>
                <?php endwhile; ?>
            </select><br>

            <label for="pickup_date">Pickup Date:</label>
            <input type="date" id="pickup_date" name="pickup_date" required><br>

            <label for="pickup_time">Pickup Time:</label>
            <input type="time" id="pickup_time" name="pickup_time" required><br>

            <label for="waste_type">Type of E-waste:</label>
            <textarea id="waste_type" name="waste_type" required></textarea><br>

            <label for="pickup_address">Pickup Address:</label>
            <input type="text" id="pickup_address" name="pickup_address" required><br>

            <button type="submit">Submit Request</button>
        </form>
    </div>
</body>
</html>