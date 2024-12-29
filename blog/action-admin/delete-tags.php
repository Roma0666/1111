<?php

include ('boostrap.php');

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    $sql = "DELETE FROM tags WHERE id = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $userId);

        if ($stmt->execute()) {
            echo "tag deleted successfully";
        } else {
            echo "Error deleting tag: " . $conn->error;
        }

        $stmt->close();
    }
} else {
    echo "tag ID not provided.";
}

$conn->close();

header("Location:admin-tags.php");
exit();

