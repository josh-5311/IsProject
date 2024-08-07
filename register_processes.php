<?php
session_start();
require_once 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];  // Add email field
    $password = $_POST['password'];
    $role = $_POST['role'];  // Assuming role selection during registration

    // Hash password
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $email, $password_hash, $role);

    // Execute and check if successful
    if ($stmt->execute()) {
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;
<<<<<<< HEAD
        header("Location: login.php");  // Redirect to user dashboard after registration
=======
        header("Location: user_dashboard.php");  // Redirect to user dashboard after registration
>>>>>>> 5f639c6bdd0ae8501e593ced01ca22f9d356f59a
        exit();
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
