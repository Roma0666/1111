<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once ('boostrap.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['username'];
    $email = trim(strip_tags($_POST['email']));
    $pass = trim(strip_tags($_POST['pass']));
    $role = 'user';
    if (empty($name) || empty($email) || empty($pass)) {
        die("Name, email, and password are required.");
    }
    $passhashed = password_hash($pass, PASSWORD_DEFAULT);
    if ($stmt = $conn->prepare("INSERT INTO users (username, pass, email, role) VALUES (?, ?, ?, ?)")) {
        $stmt->bind_param("ssss", $name, $passhashed, $email, $role);
        if ($stmt->execute()) {
            echo "created successfully.";
            echo '<a href="login.php">Login here</a>';
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}

$conn->close();
?>
