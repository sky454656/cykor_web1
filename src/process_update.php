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
        'id' => mysqli_real_escape_string($conn, $_POST['id']),
        'title'=>mysqli_real_escape_string($conn, $_POST['title']),
        'content'=>mysqli_real_escape_string($conn, $_POST['content']),
        'author'=>mysqli_real_escape_string($conn, $_POST['author'])
    );


    $sql = "
        UPDATE list
            SET
                title = '{$filtered['title']}',
                content = '{$filtered['content']}'
            WHERE
                id = '{$filtered['id']}'
    ";
    $result = mysqli_query($conn, $sql);
    header("Location: list.php");
    exit;
?>



