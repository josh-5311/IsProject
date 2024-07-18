<?php
session_start();
require_once 'db_config.php';

// Initialize feedback message variable
$feedback_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_center'])) {
        // Add new center
        $center_name = $_POST['center_name'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];
        $operating_hours = $_POST['operating_hours'];
        $description = $_POST['description'];
        $e_waste_accepted = $_POST['e_waste_accepted'];

        // Prepare SQL statement
        $stmt = $conn->prepare("INSERT INTO centers (center_name, address, contact, operating_hours, description, e_waste_accepted) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $center_name, $address, $contact, $operating_hours, $description, $e_waste_accepted);

        // Execute and check if successful
        if ($stmt->execute()) {
            $feedback_message = "Center Added Successfully.";
        } else {
            $feedback_message = "Error adding center: " . $conn->error;
        }
    } elseif (isset($_POST['delete_center'])) {
        // Delete center
        $center_id = $_POST['center_id'];

        // Prepare SQL statement
        $stmt = $conn->prepare("DELETE FROM centers WHERE center_id = ?");
        $stmt->bind_param("i", $center_id);

        // Execute and check if successful
        if ($stmt->execute()) {
            $feedback_message = "Center Deleted Successfully.";
        } else {
            $feedback_message = "Error deleting center: " . $conn->error;
        }
    }
}

// Fetch centers from the database
$centers = $conn->query("SELECT * FROM centers");

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Centers - Green Gear</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="manage-centers-body">
    <div class="manage-centers-container">
        <h2>Manage E-waste Center Locators</h2>
        
        <!-- Feedback message -->
        <?php if (!empty($feedback_message)): ?>
            <div class="feedback-message">
                <?php echo htmlspecialchars($feedback_message); ?>
            </div>
        <?php endif; ?>

        <!-- Add New Center Form -->
        <form class="form-add-center" method="POST" action="manage_centers.php">
            <h3>Add New Center</h3>
            <label for="center_name">Center Name:</label>
            <input type="text" id="center_name" name="center_name" required><br>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required><br>

            <label for="contact">Contact:</label>
            <input type="text" id="contact" name="contact" required><br>

            <label for="operating_hours">Operating Hours:</label>
            <input type="text" id="operating_hours" name="operating_hours" required><br>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea><br>

            <label for="e_waste_accepted">Accepted E-Waste:</label>
            <textarea id="e_waste_accepted" name="e_waste_accepted" required></textarea><br>

            <button type="submit" name="add_center">Add Center</button>
        </form>

        <!-- Existing Centers Table -->
        <table class="centers-table">
            <thead>
                <tr>
                    <th>Center Name</th>
                    <th>Address</th>
                    <th>Contact</th>
                    <th>Operating Hours</th>
                    <th>Description</th>
                    <th>Accepted E-Waste</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $centers->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['center_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['address']); ?></td>
                        <td><?php echo htmlspecialchars($row['contact']); ?></td>
                        <td><?php echo htmlspecialchars($row['operating_hours']); ?></td>
                        <td><?php echo htmlspecialchars($row['description']); ?></td>
                        <td><?php echo htmlspecialchars($row['e_waste_accepted']); ?></td>
                        <td>
                            <form method="POST" action="manage_centers.php">
                                <input type="hidden" name="center_id" value="<?php echo htmlspecialchars($row['center_id']); ?>">
                                <button type="submit" name="delete_center">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
