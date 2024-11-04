<?php
require_once 'session.php';
$mysqli = new mysqli("localhost", "root", "", "blog");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$article_id = $_GET['id'];

$sql_article = "SELECT title, content, created_at FROM articles WHERE id = ?";
$stmt = $mysqli->prepare($sql_article);
$stmt->bind_param("i", $article_id);
$stmt->execute();
$stmt->bind_result($title, $content, $created_at);
$stmt->fetch();
$stmt->close();

$sql_comments = "SELECT comment, created_at FROM comments WHERE article_id = ?";
$stmt = $mysqli->prepare($sql_comments);
$stmt->bind_param("i", $article_id);
$stmt->execute();
$result_comments = $stmt->get_result();
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="article.css?v=<?php echo time(); ?>">
    </link>
    <title><?php echo $title; ?></title>
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <h1><?php echo $title; ?></h1>
        <p><?php echo $content; ?></p>
        <small>Posted on <?php echo $created_at; ?></small>

        <h2>Comments</h2>
        <ul>
            <?php while ($row = $result_comments->fetch_assoc()): ?>
                <li><?php echo $row['comment']; ?> <small>(Posted on <?php echo $row['created_at']; ?>)</small></li>
            <?php endwhile; ?>
        </ul>
        <?php if (isUserLoggedIn()): ?>
            <h2>Add a Comment</h2>
            <form action="add_comment.php" method="post">
                <input type="hidden" name="article_id" value="<?php echo $article_id; ?>">
                <textarea name="comment" required></textarea>
                <button type="submit">Submit</button>
            </form>
        <?php endif; ?>

    </div>
</body>

</html>

<?php
$stmt->close();
$mysqli->close();
?>