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
    $sql = "SELECT * FROM tags WHERE title LIKE '%$searchQuery%' OR description LIKE '%$searchQuery%' LIMIT $records_per_page OFFSET $offset";
} else {
    $sql = "SELECT * FROM tags LIMIT $records_per_page OFFSET $offset";
}

$result = $conn->query($sql);

$total_result_sql = "SELECT COUNT(*) AS total FROM tags";
if (!empty($searchQuery)) {
    $total_result_sql = "SELECT COUNT(*) AS total FROM tags WHERE title LIKE '%$searchQuery%' OR description LIKE '%$searchQuery%'";
}
$total_result = $conn->query($total_result_sql);
$total_row = $total_result->fetch_assoc();
$total_records = $total_row['total'];
$total_pages = ceil($total_records / $records_per_page);
?>

<title>Admin Panel Tags</title>
<link rel="stylesheet" href="style.css">

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
        <div class="table-sup">
            <div class="title-table">Tags Table</div>
            <h2>create new tag</h2>
            <div>
                <form action="create-tag.php" method="post">
                    <input  name="name" type="text">
                    <button>create</button>
                </form>
            </div>
            <table>
                <tr>
                    <th>Id</th>
                    <th>Tag name</th>
                    <th>Action</th>
                </tr>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row['id'] . '</td>';
                        echo '<td>' . $row['tags_name'] . '</td>';
                        echo '<td><a href="delete-tags.php?id=' . $row['id'] . '">Delete</a> | <a href="update-tag.php?id=' . $row['id'] . '">Update</a></td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="5">No message found</td></tr>';
                }
                ?>
            </table>

            <div class="pagination">
                <?php
                for ($i = 1; $i <= $total_pages; $i++) {
                    echo '<a class="pagination-butt" href="admin-contact.php?page=' . $i . ($searchQuery ? '&search=' . $searchQuery : '') . '"';
                    if ($i == $page) echo ' class="active"';
                    echo '>' . $i . '</a>';
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php
$conn->close();
?>