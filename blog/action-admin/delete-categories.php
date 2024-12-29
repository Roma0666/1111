<?php

include ('boostrap.php');

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    $sql = "DELETE FROM categories WHERE id = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $userId);

        if ($stmt->execute()) {
            echo "category deleted successfully";
        } else {
            echo "Error deleting category: " . $conn->error;
        }

        $stmt->close();
    }
} else {
    echo "category ID not provided.";
}

$conn->close();

header("Location:admin-categories.php");
exit();

