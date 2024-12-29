<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include ('boostrap.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    if (empty($name)) {
        die("Name cannot be empty");
    }
    if ($stmt = $conn->prepare("INSERT INTO tags (tags_name) VALUES (?)")) {
        $stmt->bind_param("s", $name);
        if ($stmt->execute()) {
            echo "created successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}

$conn->close();
?>
