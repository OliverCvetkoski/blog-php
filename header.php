<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="header.css?v=<?php echo time(); ?>">
    <title>Blog</title>
</head>

<body>
    <header>
        <h1>Blog Articles</h1>
        <div> <a href="index.php">Home</a>
            <?php if (isUserLoggedIn()): ?>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
            <?php endif; ?>
        </div>
    </header>