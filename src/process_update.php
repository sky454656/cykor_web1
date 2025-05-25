<?php
    $conn = mysqli_connect("db", 'root', 'root', 'boarddb');
    if (!$conn) {
    die("DB 연결 실패: " . mysqli_connect_error());
    }

    $filtered = array(
        'id' => mysqli_real_escape_string($conn, $_POST['id']),
        'title'=>mysqli_real_escape_string($conn, $_POST['title']),
        'content'=>mysqli_real_escape_string($conn, $_POST['content'])
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



