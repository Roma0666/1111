<?php
include ('boostrap.php');
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    $sql = "DELETE FROM users WHERE id = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $userId);

        if ($stmt->execute()) {
            echo "User deleted successfully";
        } else {
            echo "Error deleting user: " . $conn->error;
        }

        $stmt->close();
    }
} else {
    echo "User ID not provided.";
}

$conn->close();

header("Location:admin-users.php");
exit();
?>
