<?php
include ('boostrap.php');

$isLoggedIn = isset($_SESSION['user_id']);
$userRole = isset($_SESSION['role']) ? $_SESSION['role'] : '';

if ($isLoggedIn && $userRole === 'admin') {
    echo '<title>Admin Panel</title>
    <link rel="stylesheet" href="style.css">
    <div class="admin-header">
        <div class="admin-header-item-section">
            <ul>
                <div class="head-admin">Admin Panel</div>
                <div class="item-head-admin"><li><a href="admin-users.php">Users</a></li></div>
                <div class="item-head-admin"><li><a href="admin-posts.php">Posts</a></li></div>
                <div class="item-head-admin"><li><a href="admin-categories.php">Categories</a></li></div>
                <div class="item-head-admin"><li><a href="admin-comments.php">Comments</a></li></div>
                <div class="item-head-admin"><li><a href="admin-tags.php">Tags</a></li></div>
                <div class="item-head-admin"><li><a href="admin-contact.php">Contact supp</a></li></div>
                <div class="item-head-admin"><li><a href="logout.php">Logout</a></li></div>
            </ul>
        </div>
    </div>';
} else {
    header("Location: ../");
    exit();
}

mysqli_close($conn);
?>
