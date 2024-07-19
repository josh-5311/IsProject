<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="styles.css">
</head>
<<<<<<< HEAD
<body class="main">
 <div class="background-overlay">
    <div class="container">
        <img src="img/1.png" alt="Green Gear Logo">
=======
<body>
 <div class="background-overlay">
    <div class="container">
        <img src="images/logo.png" alt="Green Gear Logo">
>>>>>>> 5f639c6bdd0ae8501e593ced01ca22f9d356f59a
        <h2>Register</h2>
        <form id="registerForm" action="register_processes.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" id="confirmPassword" required>
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select id="role" name="role">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <button type="submit" class="btn">Register</button>
<<<<<<< HEAD
            <p>Already have an account? <a href="login.php">Login here</a></p>
=======
            <p>Already have an account? <a href="login.html">Login here</a></p>
>>>>>>> 5f639c6bdd0ae8501e593ced01ca22f9d356f59a
        </form>
    </div>
</div>

    <script>
        document.getElementById('registerForm').addEventListener('submit', function(event) {
            var password = document.getElementById('password').value;
            var confirmPassword = document.getElementById('confirmPassword').value;
            if (password !== confirmPassword) {
                alert('Passwords do not match.');
                event.preventDefault();
            }
        });
    </script>
</body>
</html>
