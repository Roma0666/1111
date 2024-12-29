<?php
include ('boostrap.php');
include ("header.php");
?>
<?php

$isLoggedIn = isset($_SESSION['user_id']);
$userRole = isset($_SESSION['role']) ? $_SESSION['role'] : '';


if ($isLoggedIn) {
    echo '<link rel="stylesheet" href="style.css">
<title>Static Page</title>
<div class="form">
    <div class="text">Contact form</div>
    <form method="POST" action="send-message.php">
        <input class="form-input" type="text" name="titleMess" placeholder="title" required pattern="^[a-zA-Z0-9\s]{10,100}$" ><br>
        <input class="form-input" type="text" name="descMess" placeholder="desription" required pattern="^[a-zA-Z0-9\s]{10,100}$" ><br>
        <button class="buttton" type="submit">send</button>
    </form>
</div>';
} else {
    header("Location: index.php");
}
?>

<?php
include ("footer.php");
mysqli_close($conn);
?>
