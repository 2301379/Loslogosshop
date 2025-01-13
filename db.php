<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

$host = 'mysql305.phy.lolipop.lan'; // 管理画面で確認したホスト名
$db = 'LAA1557214-php2024';        // データベース名
$user = 'LAA1557214';              // ユーザー名
$pass = '0331';                    // パスワード

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$db;charset=utf8",
        $user,
        $pass
    );
    echo 'データベース接続成功！';
} catch (PDOException $e) {
    echo 'データベース接続エラー: ' . $e->getMessage();
}

?>

</body>
</html>