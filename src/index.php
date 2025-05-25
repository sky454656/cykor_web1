<?php
    $conn = mysqli_connect("db", 'root', 'root', 'boarddb');
    if (!$conn) {
    die("DB 연결 실패: " . mysqli_connect_error());
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
        <a href="list.php">list</a>
        <br><br><br>
        <p1>home</p1>



    </body>
</html>