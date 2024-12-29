<?php

require_once "boostrap.php";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$isLoggedIn = isset($_SESSION['user_id']);
$userRole = isset($_SESSION['role']) ? $_SESSION['role'] : '';
$post_id = isset($_GET['post_id']) ? (int)$_GET['post_id'] : 0;

if ($post_id) {

    $post_sql = "
        SELECT posts.id, posts.title, posts.description, posts.date, users.username AS author_name 
        FROM posts 
        JOIN users ON posts.id_author = users.id 
        WHERE posts.id = $post_id 
        LIMIT 1
    ";
    $post_result = $conn->query($post_sql);
    $post = $post_result->fetch_assoc();

    $comments_sql = "
        SELECT comments.text, comments.date, users.username AS commenter_name 
        FROM comments 
        JOIN users ON comments.id_author = users.id 
        WHERE comments.post_id = $post_id AND comments.is_moderate = 1
        ORDER BY comments.date DESC
    ";
    $comments_result = $conn->query($comments_sql);
}
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION["user_id"])) {
        die("User not logged in.");
    }

    $author_id = $_SESSION["user_id"];
    $comment = trim(strip_tags($_POST['comment']));

    if (!empty($comment)) {
        if (strlen($comment) > 100) {
            $error = "Error: Comment is too long. Maximum allowed length is 100 characters.";
        } elseif (!preg_match('/^[a-zA-Z0-9]+$/', $comment)) {
            $error = "Error: Comment can only contain letters and numbers.";
        } else {
            $stmt = $conn->prepare("INSERT INTO comments (post_id, id_author, text) VALUES (?, ?, ?)");
            $stmt->bind_param("iis", $post_id, $author_id, $comment);

            if ($stmt->execute()) {
                header("Location: comments.php?post_id=$post_id");
                exit();
            } else {
                $error = $stmt->error;
            }

            $stmt->close();
        }
    } else {
        $error = "Error: Comment cannot be empty.";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Comments</title>
</head>
<body>
<?php include('header.php'); ?>

<div class="post-page">
    <?php if ($post): ?>
        <div class="post-comm-section">
            <div>
                <img class="user-img" src="img/user.jpg" alt="">
                <?php echo htmlspecialchars($post['author_name']); ?>
            </div>
                <h2><?php echo htmlspecialchars($post['title']); ?></h2>
                <p><?php echo nl2br(htmlspecialchars($post['description'])); ?></p>
                <div><?php echo nl2br(htmlspecialchars($post['date'])); ?></div>
            </div>
        <hr>
        <h3>Comments:</h3>

        <?php while ($comment = $comments_result->fetch_assoc()): ?>
            <div class="comment">
                <p><strong>
                        <img class="user-img" src="img/user.jpg" alt="">
                        <?php echo htmlspecialchars($comment['commenter_name']); ?>:
                    </strong>
                    <?php echo nl2br(htmlspecialchars($comment['text'])); ?></p>
                <small><?php echo htmlspecialchars($comment['date']); ?></small>
                <hr>
            </div>
        <?php endwhile; ?>

        <?php if ($isLoggedIn): ?>
            <form method="POST">
                <div class="error-text"><?= $error ?></div>
                <textarea name="comment" placeholder="Write your comment..." required pattern="^[a-zA-Z0-9\s]{10,100}$"></textarea>
                <button class="buttton" type="submit">Post Comment</button>
            </form>
        <?php endif; ?>
    <?php else: ?>
        <p class="error-text">Post not found.</p>
    <?php endif; ?>
</div>

<?php include('footer.php'); ?>
</body>
</html>

<?php
mysqli_close($conn);
?>
