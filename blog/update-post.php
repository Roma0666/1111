<?php
include ('boostrap.php');

$isLoggedIn = isset($_SESSION['user_id']);
$userRole = isset($_SESSION['role']) ? $_SESSION['role'] : '';

if ($isLoggedIn && $userRole === 'admin') {
} else {
    header("Location: index.php");
    exit();
}
$sqlTags = "SELECT * FROM tags";
$resultTags = $conn->query($sqlTags);
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

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    $sql = "SELECT * FROM posts WHERE id = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
        } else {
            echo "Post not found.";
            exit();
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['title'];
    $email = $_POST['description'];
    $pass = $_POST['tag'];
    $role = $_POST['category'];
    $updateSql = "UPDATE posts SET title = ?, description = ?, categories_id = ?, id_tags = ? WHERE id = ?";

    if ($stmt = $conn->prepare($updateSql)) {
        $stmt->bind_param("ssssi", $username, $email, $role, $pass,$userId );

        if ($stmt->execute()) {
            echo "User updated successfully";
            header("Location: admin-posts.php");
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
    <title>Update Post</title>
</head>
<body>
<div class="form">
    <h2 class="text">Update Post</h2>

    <form method="POST" action="">
        <label for="username">Title:</label><br>
        <input class="form-input" type="text" name="title" value="<?php echo $user['title']; ?>" required><br><br>

        <label for="email">Description:</label><br>
        <input class="form-input" type="text" name="description" value="<?php echo $user['description']; ?>" required><br><br>

        <select class="form-input" name="category">
            <option value="">Select Category</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo htmlspecialchars($category['id']); ?>">
                    <?php echo htmlspecialchars($category['categories_name']); ?>
                </option>
            <?php endforeach; ?>
        </select><br>
        <select class="form-input" name="tag">
            <option value="">Select Tag</option>
            <?php foreach ($tags as $tag): ?>
                <option value="<?php echo htmlspecialchars($tag['id']); ?>">
                    <?php echo htmlspecialchars($tag['tags_name']); ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <input class="buttton" type="submit" value="Update User">
    </form>
</div>
</body>
</html>
