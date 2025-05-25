<?php
    session_start(); 
    $conn = mysqli_connect("db", 'root', 'root', 'boarddb');
    if (!$conn) {
    die("DB 연결 실패: " . mysqli_connect_error());
    }


    $filtered = array(
        'username'=>mysqli_real_escape_string($conn, $_POST['username']),
        'password'=> password_hash($_POST['password'], PASSWORD_DEFAULT)
    );


    $sql = "
        INSERT INTO users
            (username, password)
            VALUES(
                '{$filtered['username']}',
                '{$filtered['password']}'
            )
    ";

    $result = mysqli_query($conn, $sql);
    header("Location: login.php");
    exit;
?>



