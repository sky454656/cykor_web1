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

    $sql = "SELECT * FROM list ORDER BY id ASC";
    $result = mysqli_query($conn, $sql);

    $list="";
    while($row = mysqli_fetch_array($result)) {
        $title = $row['title'];
        $list = $list. "<li>
        <a href= \"list.php?id={$row['id']}\">{$title}</a>
        </li>";
    }

    $info = array(
        'title' => "",
        'content' => "",
        'author' => "",
        'created_at' => ""
    );

    if(isset($_GET['id'])){
        $sql = "SELECT * FROM list WHERE id={$_GET['id']}";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $info['title'] = $row['title'];
        $info['content'] = $row['content'];
        $info['author'] = $row['author'];
        $info['created_at'] = $row['created_at'];
    };

    if($_SESSION['username'] != $info['author'])
        echo "<script>alert('edit 권한이 없습니다!'); history.back();</script>";

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
        <a href="logout.php">logout</a>
        <h1>edit</h1>
        <form action="process_update.php" method="POST">
            <input type="hidden" name="id" value="<?=$_GET['id']?>">
            <p><input type="text" name="title" placeholder="title"
            value="<?=$info['title']?>"></p>
            <p><textarea name="content" placeholder="content"><?=$info['content']?></textarea></p>
            <input type="hidden" name="author" value="<?=$info['author']?>">
            <p><input type="submit"></p>
        </form>
    </body>
</html>