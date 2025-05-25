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
        'password'=>mysqli_real_escape_string($conn, $_POST['password'])
    );


    $sql = "SELECT * FROM users WHERE username ='{$filtered['username']}'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_array($result);

    if($user && password_verify($filtered['password'], $user['password'])){
        $_SESSION['username'] = $user['username'];
        $_SESSION['id'] = $user['id'];

    setcookie("username", $user['username'], time() + (86400 * 7), "/");

    header("Location: index.php");
    exit;
    }
    else{
        echo "<script>alert('로그인 실패'); history.back();</script>";
    }
?>



