<?php
include ('boostrap.php');
$isLoggedIn = isset($_SESSION['user_id']);
$userRole = isset($_SESSION['role']) ? $_SESSION['role'] : '';

if (!$isLoggedIn) {
    header("Location: index.php");
    exit();
}



$sql = "SELECT * FROM tags";
$resultTags = $conn->query($sql);
$tags = [];
if ($resultTags->num_rows > 0) {
    while ($row = $resultTags->fetch_assoc()) {
        $tags[] = $row;
    }
}

$sqlCategories = "SELECT * FROM categories";
$resultCategories = $conn->query($sqlCategories);
$categories = [];
if ($resultCategories->num_rows > 0) {
    while ($row = $resultCategories->fetch_assoc()) {
        $categories[] = $row;
    }
}

include("header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <title>Post Page</title>
</head>
<body>
<div class="form">
    <div class="text">Create new post for your blog</div>
    <form action="post.php" method="POST">
        <input class="form-input" type="text" name="title-post" placeholder="Title" required pattern="^[a-zA-Z0-9\s]{10,100}$"><br>
        <input class="form-input" type="text" name="desc-post" placeholder="Description" required pattern="^[a-zA-Z0-9\s]{10,100}$"><br>
        <select class="form-input" name="categories" required>
            <option value="">Select Category</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category['id']; ?>">
                    <?php echo $category['categories_name']; ?>
                </option>
            <?php endforeach; ?>
        </select><br>
        <select class="form-input" name="tags[]" multiple required>
            <?php foreach ($tags as $tag): ?>
                <option value="<?php echo $tag['id']; ?>">
                    <?php echo $tag['tags_name']; ?>
                </option>
            <?php endforeach; ?>
        </select><br>
        <button class="button" type="submit">Post</button>
    </form>

</div>
</body>
</html>

<?php
include("footer.php");
mysqli_close($conn);
?>
