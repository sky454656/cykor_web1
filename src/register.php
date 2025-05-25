<?php
    session_start(); 
    $conn = mysqli_connect("db", 'root', 'root', 'boarddb');
    if (!$conn) {
    die("DB 연결 실패: " . mysqli_connect_error());
    }

    
    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);

?>


<!doctype html>
<html>
    <head>
        <meta charset = "utf-8">
        <title>cykor</title>
    </head>
    <body>
        <a href="index.php">home</a>
        <a href="register.php">register</a>
        <a href="login.php">login</a>
        <h1>register</h1>
        <form action="process_register.php" method="POST">
            <P><input type ="text" name="username" placeholder="Username"  autocomplete="off">
            <input type="password" name="password" placeholder="Password"  autocomplete="off">
            <input type="submit">
            </P>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['username']) ?></td>
                    <td><?= htmlspecialchars($row['password']) ?></td>
                    <td><?= $row['created_at'] ?></td>
                </tr>
            <?php endwhile; ?>

    </body>
</html>