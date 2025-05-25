<?php
    session_start(); 
    $conn = mysqli_connect("db", 'root', 'root', 'boarddb');
    if (!$conn) {
    die("DB 연결 실패: " . mysqli_connect_error());
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
        <h1>delete</h1>
        <p>Are you sure you want to delete this post?</p>
        <p>Title : <?=$info['title']?></p>
        <p>Content : <?=$info['content']?></p>
        <form action="process_delete.php" method="POST">
            <input type="hidden" name="id" value="<?=$_GET['id']?>">    
            <p><input type="submit" value="delete"></p>
        </form>
    </body>
</html>