<?php

include 'boostrap.php';

$sql = mysqli_query($conn, "
    SELECT posts.id, posts.title, posts.description, posts.date, users.username 
    FROM posts 
    JOIN users ON posts.id_author = users.id
");

if (!$sql) {
    die("SQL Error: " . mysqli_error($conn));
}

$goods = mysqli_fetch_all($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Home page</title>
</head>
<body>
<?php include('header.php'); ?>
<div class="main-part-page">
    <div class="post-block">
        <div class="text">Find post</div>
        <form method="get" action="find-post.php">
            <input type="text" placeholder="search" name="search" class="form-find">
            <button type="submit" class="buttton">find</button>
        </form>
    </div>
    <div class="posts-block">
        <?php
        foreach ($goods as $post) {
            echo '
<div class="position-posts">
<div class="post">
    <div class="post-author"><img class="user-img" src="img/user.jpg" alt="">' . htmlspecialchars($post[4]) . '</div>
    <div class="post-title">' . htmlspecialchars($post[1]) . '</div>
    <div class="post-desc">' . htmlspecialchars($post[2]) . '</div>
    <div class="post-date">' . htmlspecialchars($post[3]) . '</div>
    <div><a href="comments.php?post_id=' . htmlspecialchars($post[0]) . '">comments</a></div>
</div>
</div>';
        }
        ?>
    </div>
</div>
<?php include('footer.php'); ?>
</body>
</html>
<?php
mysqli_close($conn);
?>
