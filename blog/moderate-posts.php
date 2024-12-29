<?php

include('boostrap.php');

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    $sql = "UPDATE  posts SET is_moderate = 1 WHERE id = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $userId);

        if ($stmt->execute()) {
            echo "successfully";
        } else {
            echo "Error : " . $conn->error;
        }

        $stmt->close();
    }
} else {
    echo "post ID not provided.";
}

$conn->close();

header("Location:admin-posts.php");
exit();
