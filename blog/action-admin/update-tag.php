<?php
include ('boostrap.php');

session_start();

$isLoggedIn = isset($_SESSION['user_id']);
$userRole = isset($_SESSION['role']) ? $_SESSION['role'] : '';

if ($isLoggedIn && $userRole === 'admin') {
} else {
    header("Location: index.php");
    exit();
}

if (isset($_GET['id'])) {
    $tagId = $_GET['id'];

    $sql = "SELECT * FROM tags WHERE id = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $tagId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $tag = $result->fetch_assoc();
        } else {
            echo "tag not found.";
            exit();
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tagname = $_POST['name'];
    $updateSql = "UPDATE tags SET tags_name = ? WHERE id = ?";

    if ($stmt = $conn->prepare($updateSql)) {
        $stmt->bind_param("si", $tagname, $tagId);

        if ($stmt->execute()) {
            echo "tag updated successfully";
            header("Location: admin-tags.php");
            exit();
        } else {
            echo "Error updating tag: " . $conn->error;
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
    <title>Update tag</title>
</head>
<body>
<div class="form">
<h2 class="text">Update tag</h2>

<form method="POST" action="">
    <label for="username">Tag name:</label><br>
    <input class="form-input" type="text" name="name" value="<?php echo $tag['tags_name']; ?>" required><br><br>

    <input class="buttton" type="submit" value="Update tag">
</form>
</div>
</body>
</html>
