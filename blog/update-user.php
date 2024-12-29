<?php
include ('boostrap.php');

$isLoggedIn = isset($_SESSION['user_id']);
$userRole = isset($_SESSION['role']) ? $_SESSION['role'] : '';

if ($isLoggedIn && $userRole === 'admin') {
} else {
    header("Location: index.php");
    exit();
}

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    $sql = "SELECT * FROM users WHERE id = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
        } else {
            echo "User not found.";
            exit();
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $role = $_POST['role'];
    $passhash = password_hash($pass, PASSWORD_DEFAULT);
    $updateSql = "UPDATE users SET username = ?, email = ?, pass = ?, role = ? WHERE id = ?";

    if ($stmt = $conn->prepare($updateSql)) {
        $stmt->bind_param("ssssi", $username, $email, $passhash, $role, $userId);

        if ($stmt->execute()) {
            echo "User updated successfully";
            header("Location: admin-panel.php");
            exit();
        } else {
            echo "Error updating user: " . $conn->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Update User</title>
</head>
<body>
<div class="form">
<h2 class="text">Update User</h2>

<form method="POST" action="">
    <label for="username">Username:</label><br>
    <input class="form-input" type="text" name="username" value="<?php echo $user['username']; ?>" required><br><br>

    <label for="email">Email:</label><br>
    <input class="form-input" type="email" name="email" value="<?php echo $user['email']; ?>" required><br><br>

    <label for="pass">Password:</label><br>
    <input class="form-input" type="password" name="pass" value="<?php echo $user['pass']; ?>" required><br><br>

    <label for="role">Role:</label><br>
    <select class="form-input" name="role" required>
        <option value="<?php echo $user['role']; ?>"><?php echo $user['role']; ?> </option>
        <option value="admin">admin</option>
        <option value="user">user</option>
    </select><br>

    <input class="buttton" type="submit" value="Update User">
</form>
</div>
</body>
</html>
