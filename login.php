<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
        <h2>Login</h2>
        <form id="loginForm" action="login_processes.php" method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn">Login</button>
<<<<<<< HEAD
            <p>Don't have an account? <a href="register.php">Register here</a></p>
=======
            <p>Don't have an account? <a href="register.html">Register here</a></p>
>>>>>>> 5f639c6bdd0ae8501e593ced01ca22f9d356f59a
        </form>
    </div>
</div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;
            if (email === '' || password === '') {
                alert('Please fill in all fields.');
                event.preventDefault();
            }
        });
    </script>
</body>
</html>
