<?php
require_once 'session.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mysqli = new mysqli("localhost", "root", "", "blog");

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "INSERT INTO articles (title, content) VALUES (?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $title, $content);
    $stmt->execute();

    $stmt->close();
    $mysqli->close();

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="add_article.css?v=<?php echo time(); ?>">
    <title>Add Article</title>
</head>

<body>
    <?php include "header.php"; ?>
    <h1>Add a New Article</h1>
    <form action="add_article.php" method="post">
        <input type="text" name="title" placeholder="Title" required>
        <textarea name="content" placeholder="Content" required></textarea>
        <button type="submit">Submit</button>
    </form>
</body>

</html>