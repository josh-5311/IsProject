<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e-waste_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
<<<<<<< HEAD
?>
=======

>>>>>>> 5f639c6bdd0ae8501e593ced01ca22f9d356f59a
