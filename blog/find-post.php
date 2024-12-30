<?php

include('boostrap.php');
echo '<link rel="stylesheet" href="style.css">';
$searchTerm = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
var_dump($searchTerm);
$sql = "
    SELECT 
        posts.id, 
        posts.title, 
        posts.description, 
        posts.date, 
        users.username AS author_name, 
        categories.categories_name AS category_name,
        (SELECT GROUP_CONCAT(tags.tags_name ORDER BY tags.tags_name ASC SEPARATOR ', ') 
         FROM post_tags 
         JOIN tags ON post_tags.tag_id = tags.id 
         WHERE post_tags.post_id = posts.id) AS tag_names
    FROM posts
    JOIN users ON posts.id_author = users.id
    JOIN categories ON posts.categories_id = categories.id
    WHERE 1
";

if ($searchTerm) {
    $searchTerm = trim($searchTerm);
    $sql .= " AND (
        users.username LIKE '%$searchTerm%' OR 
        posts.title LIKE '%$searchTerm%' OR 
        posts.description LIKE '%$searchTerm%' OR 
        categories.categories_name LIKE '%$searchTerm%' OR 
        EXISTS (
            SELECT 1
            FROM post_tags
            JOIN tags ON post_tags.tag_id = tags.id
            WHERE post_tags.post_id = posts.id
            AND tags.tags_name LIKE '%$searchTerm%'
        )
    )";
}

$sql .= " ORDER BY posts.date DESC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Results:</h2>";
    while ($row = $result->fetch_assoc()) {
        echo '<div class="post find-post">
            <div class="post-author"><img class="user-img" src="img/user.jpg" alt="">' . htmlspecialchars($row['author_name']) . '</div>
            <div class="post-title">' . htmlspecialchars($row['title']) . '</div>
            <div class="post-desc">' . htmlspecialchars($row['description']) . '</div>
            <div class="post-category">Category: ' . htmlspecialchars($row['category_name']) . '</div>
            <div class="post-tags">Tags: ' . htmlspecialchars($row['tag_names']) . '</div>
            <div class="post-date">' . htmlspecialchars($row['date']) . '</div>
            <div class="post-comments"><a href="comments.php?post_id=' . $row['id'] . '">View Comments</a></div>
        </div>';
    }
} else {
    echo "<p>No results found</p>";
}

$conn->close();

?>
