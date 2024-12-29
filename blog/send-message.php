<?php
include ('boostrap.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim(strip_tags($_POST['titleMess']));
    $desc = trim(strip_tags($_POST['descMess']));

    if (!isset($_SESSION['username']) || !isset($_SESSION['user_id'])) {
        die("You must be logged in to send a message.");
    }

    $username = $_SESSION['username'];
    $id_author = $_SESSION['user_id'];


    if (empty($title)) {
        echo "The title is required.";
    } elseif (strlen($title) < 5 || strlen($title) > 30) {
        echo "The title must be between 5 and 30 characters.";
    } elseif (!preg_match('/^[a-zA-Z0-9а-яА-ЯіІїЇєЄґҐ\s]+$/u', $title)) {
        echo "The title can only contain letters, numbers, and spaces.";
    }

    if (empty($desc)) {
        echo"The description is required.";
    } elseif (strlen($desc) < 10 || strlen($desc) >100 ) {
        echo "The description must be between 10 and 100 characters.";
    } elseif (!preg_match('/^[a-zA-Z0-9а-яА-ЯіІїЇєЄґҐ\s]+$/u', $desc)) {
        echo "The description can only contain letters, numbers, and spaces.";
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<div>" . htmlspecialchars($error) . "</div>";
        }
    } else {
        $stmt = $conn->prepare("INSERT INTO contacts (id_author, author, title, description) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $id_author, $username, $title, $desc);

        if ($stmt->execute()) {
            echo "Message inserted successfully!";
        } else {
            echo "<div>Error: " . htmlspecialchars($stmt->error) . "</div>";
        }

        $stmt->close();
    }
}

$conn->close();
?>
