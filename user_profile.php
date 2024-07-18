<?php
session_start();
require_once 'db_config.php';

// Fetch current user information
$user_id = $_SESSION['user_id']; // Assuming user is logged in and user_id is stored in session
$user_query = $conn->prepare("SELECT username, email, phone, address FROM users WHERE user_id = ?");
$user_query->bind_param("i", $user_id);
$user_query->execute();
$user_query->bind_result($name, $email, $phone, $address);
$user_query->fetch();
$user_query->close();

// Initialize feedback message variable
$feedback_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Update user profile
    $new_name = $_POST['username'];
    $new_email = $_POST['email'];
    $new_phone = $_POST['phone'];
    $new_address = $_POST['address'];

    // Prepare SQL statement
    $update_stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, phone = ?, address = ? WHERE user_id = ?");
    $update_stmt->bind_param("sssii", $new_name, $new_email, $new_phone, $new_address, $user_id);

    // Execute and check if successful
    if ($update_stmt->execute()) {
        $feedback_message = "Profile updated successfully.";
        // Update session variables if needed
        $_SESSION['username'] = $new_name;
        $_SESSION['email'] = $new_email;
    } else {
        $feedback_message = "Error updating profile: " . $conn->error;
    }

    $update_stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Profile - Green Gear</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="update-profile-body">
    <div class="update-profile-container">
        <h2>Update Your Profile</h2>

        <!-- Feedback message -->
        <?php if (!empty($feedback_message)): ?>
            <div class="feedback-message">
                <?php echo htmlspecialchars($feedback_message); ?>
            </div>
        <?php endif; ?>

        <!-- Update Profile Form -->
        <form class="form-update-profile" method="POST" action="user_profile.php">
            <label for="name">Name:</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($name); ?>" required><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required><br>

            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($phone); ?>" required><br>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($address); ?>" required><br>

            <button type="submit">Update Profile</button>
        </form>
    </div>
</body>
</html>