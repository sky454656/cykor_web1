<?php
    $conn = mysqli_connect("db", 'root', 'root', 'boarddb');
    if (!$conn) {
    die("DB 연결 실패: " . mysqli_connect_error());
    }

    $filtered = array(
        'id' => mysqli_real_escape_string($conn, $_POST['id']),
    );


    $sql = "
        DELETE
            FROM list
            WHERE id = '{$filtered['id']}'
    ";
    $result = mysqli_query($conn, $sql);
    header("Location: list.php");
    exit;
?>

