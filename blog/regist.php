<?php
include ("header.php");
?>
    <link rel="stylesheet" href="style.css">
    <title>Create new account</title>
    <div class="form">
        <div class="text">Create account</div>
        <form method="POST" action="create-account.php">
            <input class="form-input" type="text" name="username" placeholder="user name" required><br>
            <input class="form-input" name="email" type="email" placeholder="email" required><br>
            <input class="form-input" name="pass" type="password" placeholder="password" required><br>
            <button class="buttton" type="submit">create</button>
        </form>

    </div>
<?php
include ("footer.php");
?>
