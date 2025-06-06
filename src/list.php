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

    $sql = "SELECT * FROM list";
    $result = mysqli_query($conn, $sql);

    $list="";
    while($row = mysqli_fetch_array($result)) {
        $title = htmlspecialchars($row['title']);
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

        if($row) {
            $info['title'] = $row['title'];
            $info['content'] = $row['content'];
            $info['author'] = $row['author'];
            $info['created_at'] = $row['created_at'];
        
            $update_link = '<a href="update.php?id='.$_GET['id'].'">edit</a>';
            $delete_link = '<a href="delete.php?id='.$_GET['id'].'">delete</a>';
        
        }else {
            echo "<script>alert('존재하지 않는 게시글입니다.'); history.back();</script>";
            exit;
        }
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
        <a href="logout.php">logout</a>
        <ol>
            <h1>list</h1>
            <?=$list?>
        </ol>


        <?php if(isset($_GET['id'])): ?>
            <h2><?=htmlspecialchars($info['title'])?></h2>
            <p>By <?=htmlspecialchars($info['author'])?></p>
            <p><?=htmlspecialchars($info['content'])?></P>
            <p>Created at: <?=$info['created_at']?></p>
            <br>
            <?=$update_link?>
            <?=$delete_link?>
        <?php endif; ?>
        
    </body>
</html>