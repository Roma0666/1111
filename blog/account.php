<?php
include ('boostrap.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = trim(strip_tags($_POST['email']));
    $pass = trim(strip_tags($_POST['pass']));
    $role = 'user';
    $passHashed = password_hash($pass, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, pass, email, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $passHashed, $email, $role);

    if ($stmt->execute()) {
        header('Location: admin-users.php');
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
