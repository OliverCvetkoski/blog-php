<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mysqli = new mysqli("localhost", "root", "", "blog");

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    $article_id = $_POST['article_id'];
    $comment = $_POST['comment'];

    $sql = "INSERT INTO comments (article_id, comment) VALUES (?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("is", $article_id, $comment);
    $stmt->execute();

    $stmt->close();
    $mysqli->close();

    header("Location: article.php?id=" . $article_id);
    exit();
}
?>