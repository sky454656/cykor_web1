<?php
    session_start(); 
    $conn = mysqli_connect("db", 'root', 'root', 'boarddb');
    if (!$conn) {
    die("DB 연결 실패: " . mysqli_connect_error());
    }

    if(isset($_SESSION['username'])) {
        header("Location: index.php");
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
        <a href="register.php">register</a>
        <a href="login.php">login</a>
        <h1>register</h1>
        <form action="process_register.php" method="POST">
            <P><input type ="text" name="username" placeholder="Username"  autocomplete="off">
            <input type="password" name="password" placeholder="Password"  autocomplete="off">
            <input type="submit">
            </P>
    </body>
</html>