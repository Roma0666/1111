<?php

include 'boostrap.php';
include ("header.php");
?>
<link rel="stylesheet" href="style.css">
<title>Login</title>
<div class="form">
    <div class="text">Login</div>
    <form method="POST" action="enter-account.php">
        <input class="form-input" type="text" name="username" placeholder="user name" required><br>
        <input class="form-input" name="pass" type="password" placeholder="password" required><br>
        <button class="buttton" type="submit">login</button><div>don`t have account <a href="regist.php">create</a></div>
    </form>

</div>
<?php
include ("footer.php");
mysqli_close($conn);
?>

