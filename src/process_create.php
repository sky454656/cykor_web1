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

    $filtered = array(
        'title'=>mysqli_real_escape_string($conn, $_POST['title']),
        'content'=>mysqli_real_escape_string($conn, $_POST['content']),
        'author'=>mysqli_real_escape_string($conn, $_SESSION['username'])
    );


    $sql = "
        INSERT INTO list
            (title, content, author)
            VALUES(
                '{$filtered['title']}',
                '{$filtered['content']}',
                '{$filtered['author']}'
            )
    ";

    $result = mysqli_query($conn, $sql);
    header("Location: index.php");
    exit;
?>



