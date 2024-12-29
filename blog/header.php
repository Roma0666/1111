
<?php

$isLoggedIn = isset($_SESSION['user_id']);
$userRole = isset($_SESSION['role']) ? $_SESSION['role'] : '';
?>

<div class="header">
    <div class="header-item-section">
        <ul>
            <div class="header-item"><li><a href="index.php">Home page</a></li></div>

            <?php
            if ($isLoggedIn) {
                echo '<div class="header-item"><li><a href="contact.php">Static Page</a></li></div>';
                echo '<div class="header-item"><li><a href="post-page.php">Post page</a></li></div>';
                echo '<div class="header-item"><li><a>' . $_SESSION['username'] . '</a></li></div>';
                echo '<div class="header-item"><li><a href="logout.php">Logout</a></li></div>';
            } else {
                echo '<div class="header-item"><li><a href="login.php">Login/Register</a></li></div>';
            }
            ?>
        </ul>
    </div>
</div>
