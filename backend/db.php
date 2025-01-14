<?php
// Database connection configuration
$host = "localhost"; // Change as per your server configuration
$db_name = "my_database"; // Replace with your database name
$username = "root"; // Replace with your database username
$password = "Isha"; // Replace with your database password

try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}
?>
