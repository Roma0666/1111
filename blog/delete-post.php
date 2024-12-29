<?php

include ('boostrap.php');

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    $sql = "DELETE FROM posts WHERE id = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $userId);

        if ($stmt->execute()) {
            echo "mess deleted successfully";
        } else {
            echo "Error deleting mess: " . $conn->error;
        }

        $stmt->close();
    }
} else {
    echo "mess ID not provided.";
}

$conn->close();

header("Location:admin-posts.php");
exit();

