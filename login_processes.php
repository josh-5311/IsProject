<?php
session_start();
require_once 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
<<<<<<< HEAD
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare SQL statement
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Debugging output
    if ($user) {
        echo "User found: " . $user['username'] . "<br>";
        echo "Role: " . $user['role'] . "<br>";
    } else {
        echo "No user found with that email.<br>";
    }

    // Verify password
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['user_id'] =$user['user_id']; // Store user_id in session

        if ($user['role'] == 'admin') {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: user_dashboard.php");
        }
        exit();
    } else {
        echo "Invalid email or password.";
=======
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare SQL statement
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $row['role'];

            if ($row['role'] == 'admin') {
                header("Location: admin_dashboard.php"); // Redirect to admin dashboard
            } else {
                header("Location: user_dashboard.php"); // Redirect to user dashboard
            }
            exit();
        } else {
            $error_message = "Incorrect password";
        }
    } else {
        $error_message = "Username not found";
>>>>>>> 5f639c6bdd0ae8501e593ced01ca22f9d356f59a
    }
}
?>
