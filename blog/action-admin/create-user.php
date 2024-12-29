<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
$userRole = isset($_SESSION['role']) ? $_SESSION['role'] : '';

if ($isLoggedIn && $userRole === 'admin') {

} else {
    header("Location: index.php");
    exit();
}
?>
<link rel="stylesheet" href="style.css">
<title>Login</title>
<div class="form">
    <div class="text">Create user</div>
    <form method="POST" action="account.php">
        <input class="form-input" type="text" name="username" placeholder="user name" required><br>
        <input class="form-input" name="email" type="email" placeholder="email" required><br>

        <select class="form-input" name="role" required>
            <option value="" disabled selected>Select role</option>
            <option value="admin">admin</option>
            <option value="user">user</option>
        </select><br>

        <input class="form-input" name="pass" type="password" placeholder="password" required><br>
        <button class="buttton" type="submit">create</button>
    </form>
</div>