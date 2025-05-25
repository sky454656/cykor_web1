<?php
    session_start(); 
    $conn = mysqli_connect("db", 'root', 'root', 'boarddb');
    if (!$conn) {
    die("DB 연결 실패: " . mysqli_connect_error());
    }

    $filtered = array(
        'title'=>mysqli_real_escape_string($conn, $_POST['title']),
        'content'=>mysqli_real_escape_string($conn, $_POST['content'])
    );


    $sql = "
        INSERT INTO list
            (title, content, author)
            VALUES(
                '{$filtered['title']}',
                '{$filtered['content']}',
                'tmp'
            )
    ";

    $result = mysqli_query($conn, $sql);
    header("Location: index.php");
    exit;
?>



