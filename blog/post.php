<?php

include('boostrap.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION["user_id"])) {
        die("User not logged in.");
    }

    $author_id = $_SESSION["user_id"];
    $title = trim(strip_tags($_POST['title-post']));
    $desc = trim(strip_tags($_POST['desc-post']));
    $tags = isset($_POST['tags']) ? $_POST['tags'] : [];
    $category_id = isset($_POST['categories']) ? (int)$_POST['categories'] : 0;

    if (empty($title) || empty($desc)) {
        echo "Please enter both title and description for your post.";
    } elseif (strlen($title) < 10 || strlen($desc) < 10) {
        echo "Title and description must be at least 10 characters long.";
    } elseif (strlen($title) > 100 || strlen($desc) > 100) {
        echo "Title and description must be no more than 100 characters.";
    } elseif (!preg_match('/^[a-zA-Z0-9\s]+$/', $title) || !preg_match('/^[a-zA-Z0-9\s]+$/', $desc)) {
        echo "Title and description can only contain letters, numbers, and spaces.";
    } else {
        $conn->begin_transaction();

        try {
            $stmt = $conn->prepare("INSERT INTO posts (title, description, id_author, categories_id) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssii", $title, $desc, $author_id, $category_id);

            if (!$stmt->execute()) {
                throw new Exception("Error: " . $stmt->error);
            }
            $post_id = $stmt->insert_id;
            $stmt->close();

            if (!empty($tags)) {
                $stmt = $conn->prepare("INSERT INTO post_tags (post_id, tag_id) VALUES (?, ?)");

                foreach ($tags as $tag_id) {
                    $tag_id = (int)$tag_id;
                    $stmt->bind_param("ii", $post_id, $tag_id);

                    if (!$stmt->execute()) {
                        throw new Exception("Error: " . $stmt->error);
                    }
                }
                $stmt->close();
            }

            $conn->commit();
            echo "Post created successfully!";
        } catch (Exception $e) {
            $conn->rollback();
            echo "Failed to create post: " . $e->getMessage();
        }
    }
}

$conn->close();


?>
