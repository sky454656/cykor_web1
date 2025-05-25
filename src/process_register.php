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

    $filtered = array(
        'username'=>mysqli_real_escape_string($conn, $_POST['username']),
        'password'=> password_hash($_POST['password'], PASSWORD_DEFAULT)
    );

    $sql = "SELECT * FROM users WHERE username = '{$filtered['username']}'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('이미 존재하는 아이디입니다.'); history.back();</script>";
        exit;
    }

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



