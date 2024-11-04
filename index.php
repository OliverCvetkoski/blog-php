<?php
require_once 'session.php';

$mysqli = new mysqli("localhost", "root", "", "blog");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$sql = "SELECT id, title, created_at FROM articles";
$result = $mysqli->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css?v=<?php echo time(); ?>">
    </link>
    <title>Blog</title>
</head>

<body>
    <?php include "header.php"; ?>
    <div class="container">
        <?php if (isset($_SESSION['user_id'])): ?>
            <h2>Welcome, <span class="username"> <?php echo htmlspecialchars(getLoggedInUsername($mysqli)); ?></span></h2>
        <?php endif; ?>
        <?php if (isUserLoggedIn()): ?>
            <a href="add_article.php" class="addNewArticleBtn">Add New Article</a>
        <?php endif; ?>
        <section>
            <?php while ($row = $result->fetch_assoc()): ?>
                <a class="article" href="article.php?id=<?php echo $row['id']; ?>">
                    <h3><?php echo $row['title']; ?></h3>
                    <small>Posted on <?php echo $row['created_at']; ?></small>
                </a>
            <?php endwhile; ?>
        </section>
    </div>
</body>

</html>

<?php $mysqli->close(); ?>