<?php
session_start();

function isUserLoggedIn()
{
    return isset($_SESSION['user_id']);
}

function getLoggedInUsername($mysqli)
{
    if (isUserLoggedIn()) {
        $user_id = $_SESSION['user_id'];
        $sql_user = "SELECT username FROM users WHERE id = ?";
        $stmt_user = $mysqli->prepare($sql_user);
        if ($stmt_user) {
            $stmt_user->bind_param("i", $user_id);
            $stmt_user->execute();
            $stmt_user->bind_result($username);
            $stmt_user->fetch();
            $stmt_user->close();
            return $username;
        }
    }
    return null;
}
?>