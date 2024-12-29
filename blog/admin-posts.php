<?php
include ('boostrap.php');

$isLoggedIn = isset($_SESSION['user_id']);
$userRole = isset($_SESSION['role']) ? $_SESSION['role'] : '';

if ($isLoggedIn && $userRole === 'admin') {

} else {
    header("Location: index.php");
    exit();
}

$records_per_page = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $records_per_page;

$searchQuery = '';
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $searchQuery = $conn->real_escape_string($_GET['search']);
    $sql = "
        SELECT 
            posts.id,
            users.username AS author_name,
            posts.title,
            posts.description,
            posts.date,
            categories.categories_name AS category_name,
            GROUP_CONCAT(tags.tags_name SEPARATOR ', ') AS tag_names
        FROM 
            posts
        LEFT JOIN 
            users ON posts.id_author = users.id
        LEFT JOIN 
            categories ON posts.categories_id = categories.id
        LEFT JOIN 
            post_tags ON posts.id = post_tags.post_id
        LEFT JOIN 
            tags ON post_tags.tag_id = tags.id
        WHERE 
            posts.title LIKE '%$searchQuery%' OR posts.description LIKE '%$searchQuery%'
        GROUP BY 
            posts.id
        LIMIT $records_per_page OFFSET $offset
    ";
} else {
    $sql = "
        SELECT 
            posts.id,
            users.username AS author_name,
            posts.title,
            posts.description,
            posts.date,
            posts.is_moderate,
            categories.categories_name AS category_name,
            GROUP_CONCAT(tags.tags_name SEPARATOR ', ') AS tag_names
        FROM 
            posts
        LEFT JOIN 
            users ON posts.id_author = users.id
        LEFT JOIN 
            categories ON posts.categories_id = categories.id
        LEFT JOIN 
            post_tags ON posts.id = post_tags.post_id
        LEFT JOIN 
            tags ON post_tags.tag_id = tags.id
        GROUP BY 
            posts.id
        LIMIT $records_per_page OFFSET $offset
    ";
}

$result = $conn->query($sql);

$total_result_sql = "SELECT COUNT(*) AS total FROM posts";
if (!empty($searchQuery)) {
    $total_result_sql = "SELECT COUNT(*) AS total FROM posts WHERE title LIKE '%$searchQuery%' OR description LIKE '%$searchQuery%'";
}
$total_result = $conn->query($total_result_sql);
$total_row = $total_result->fetch_assoc();
$total_records = $total_row['total'];
$total_pages = ceil($total_records / $records_per_page);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel Post</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="position-admin">
    <div class="admin-header">
        <div class="admin-header-item-section">
            <ul>
                <div class="head-admin">Admin Panel</div>
                <div class="item-head-admin"><li><a href="admin-users.php">Users</a></li></div>
                <div class="item-head-admin"><li><a href="admin-posts.php">Posts</a></li></div>
                <div class="item-head-admin"><li><a href="admin-categories.php">Categories</a></li></div>
                <div class="item-head-admin"><li><a href="admin-comments.php">Comments</a></li></div>
                <div class="item-head-admin"><li><a href="admin-tags.php">Tags</a></li></div>
                <div class="item-head-admin"><li><a href="admin-contact.php">Contact supp</a></li></div>
                <div class="item-head-admin"><li><a href="logout.php">Logout</a></li></div>
            </ul>
        </div>
    </div>
    <div class="position-table">
        <div class="title-table">Posts table</div>
        <table>
            <tr>
                <th>Id</th>
                <th>Author</th>
                <th>Title</th>
                <th>Description</th>
                <th>Date</th>
                <th>Tags</th>
                <th>Category</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['id'] . '</td>';
                    echo '<td>' . $row['author_name'] . '</td>';
                    echo '<td>' . $row['title'] . '</td>';
                    echo '<td>' . $row['description'] . '</td>';
                    echo '<td>' . $row['date'] . '</td>';
                    echo '<td>' . $row['tag_names'] . '</td>';
                    echo '<td>' . $row['category_name'] . '</td>';
                    echo '<td>' . $row['is_moderate'] . '</td>';
                    echo '<td><a href="delete-post.php?id=' . $row['id'] . '">Delete</a> | <a href="update-post.php?id=' . $row['id'] . '">Update</a>| <a href="moderate-posts.php?id=' . $row['id'] . '">Accept</a></td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="8">No posts found</td></tr>';
            }
            ?>
        </table>
        <div class="pagination">
            <?php
            for ($i = 1; $i <= $total_pages; $i++) {
                echo '<a class="pagination-butt" href="admin-posts.php?page=' . $i . ($searchQuery ? '&search=' . $searchQuery : '') . '"';
                if ($i == $page) echo ' class="active"';
                echo '>' . $i . '</a>';
            }
            ?>
        </div>
    </div>
</div>
<?php
$conn->close();
?>
</body>
</html>
