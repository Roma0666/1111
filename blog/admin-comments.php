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
    $sql = "SELECT comments.id, comments.text, comments.post_id, comments.date,comments.is_moderate, users.username AS author_name 
            FROM comments 
            JOIN users ON comments.id_author = users.id 
            WHERE comments.text LIKE '%$searchQuery%' OR comments.post_id LIKE '%$searchQuery%' 
            LIMIT $records_per_page OFFSET $offset";
} else {
    $sql = "SELECT comments.id, comments.text, comments.post_id, comments.date,comments.is_moderate, users.username AS author_name 
            FROM comments 
            JOIN users ON comments.id_author = users.id 
            LIMIT $records_per_page OFFSET $offset";
}

$result = $conn->query($sql);

$total_result_sql = "SELECT COUNT(*) AS total FROM comments";
if (!empty($searchQuery)) {
    $total_result_sql = "SELECT COUNT(*) AS total FROM comments WHERE text LIKE '%$searchQuery%' OR post_id LIKE '%$searchQuery%'";
}
$total_result = $conn->query($total_result_sql);
$total_row = $total_result->fetch_assoc();
$total_records = $total_row['total'];
$total_pages = ceil($total_records / $records_per_page);
?>

<title>Admin Panel Comments</title>
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
            <div class="title-table">Comments Table</div>

            <form method="get" action="admin-contact.php">
                <label for="search">Find Message</label>
                <input type="text" id="search" name="search" value="<?php echo htmlspecialchars($searchQuery); ?>" />
                <button type="submit">Search</button>
            </form>

            <table>
                <tr>
                    <th>Id</th>
                    <th>Author</th>
                    <th>Text</th>
                    <th>Post Id</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>

                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row['id'] . '</td>';
                        echo '<td>' . htmlspecialchars($row['author_name']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['text']) . '</td>';
                        echo '<td>' . $row['post_id'] . '</td>';
                        echo '<td>' . $row['date'] . '</td>';
                        echo '<td>' . $row['is_moderate'] . '</td>';
                        echo '<td><a href="delete-comment.php?id=' . $row['id'] . '">Delete</a> || <a href="moderate-comment.php?id=' . $row['id'] . '">Accept</a></td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="5">No comment found</td></tr>';
                }
                ?>
            </table>

            <div class="pagination">
                <?php
                for ($i = 1; $i <= $total_pages; $i++) {
                    echo '<a class="pagination-butt" href="admin-comments.php?page=' . $i . ($searchQuery ? '&search=' . $searchQuery : '') . '"';
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
