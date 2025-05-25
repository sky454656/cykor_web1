<?php
    session_start(); 
    $conn = mysqli_connect("db", 'root', 'root', 'boarddb');
    if (!$conn) {
    die("DB 연결 실패: " . mysqli_connect_error());
    }

    if(!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit;
    }
?>


<!doctype html>
<html>
    <head>
        <meta charset = "utf-8">
        <title>cykor</title>
    </head>
    <body>
        <a href="index.php">home</a>
        <a href="create.php">create</a>
        <form action = "process_create.php" method="POST">
            <p><input type="text" name="title" placeholder="title"></p>
            <p><textarea name="content" placeholder="content"></textarea></p>
            <p><input type="submit"></p>
        </form>
    </body>
</html>