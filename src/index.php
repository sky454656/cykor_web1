<?php
    session_start(); 
    $conn = mysqli_connect("db", 'root', 'root', 'boarddb');
    if (!$conn) {
    die("DB 연결 실패: " . mysqli_connect_error());
    }   

    if(isset($_SESSION['username'])){
        $current_user = "
        <a href=\"index.php\">home</a>
        <a href=\"create.php\">create</a>
        <a href=\"list.php\">list</a>
        <a href=\"logout.php\">logout</a>
        <h1>home</h1>
        You are logged in as {$_SESSION['username']}
        ";
    }
    else {
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
        <?=$current_user?>
    </body>
</html>