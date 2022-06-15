<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "recipe-keeper";
$dsn = "mysql:host=$host;dbname=$dbname";
try {
    $conn = new PDO($dsn, $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error code: " . $e->getMessage();
    echo '<script>console.log("database not working");</script>';
}
