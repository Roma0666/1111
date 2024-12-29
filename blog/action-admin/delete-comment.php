<?php

include ('boostrap.php');
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    $sql = "DELETE FROM comments WHERE id = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $userId);

        if ($stmt->execute()) {
            echo "comment deleted successfully";
        } else {
            echo "Error deleting comment: " . $conn->error;
        }

        $stmt->close();
    }
} else {
    echo "comment ID not provided.";
}

$conn->close();

header("Location:admin-comments.php");
exit();

