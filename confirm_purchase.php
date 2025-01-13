<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loslogos</title>
    <link rel="stylesheet" href="./css/syousai.css">
</head>

<body>
    <div class="container">
        <div class="top-bar">
            <a href="index.php">
                <span class="site-title">𝓛𝓸𝓼𝓵𝓸𝓰𝓸𝓼</span>
            </a>
            <a href="cart_view.php">
                <button class="cart-btn">🛒</button>
            </a>
        </div>
        <?php
session_start();
require 'db_connection.php';//データベース接続

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 購入者情報を取得
    $name = $_POST['name'];
    $postal_code = $_POST['postal_code'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    // データベースに登録
    try {
        // トランザクション開始
        $pdo->beginTransaction();

        // customers テーブルに購入者情報を挿入
        $stmt = $pdo->prepare('INSERT INTO customers (name, postal_code, address, phone, email) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$name, $postal_code, $address, $phone, $email]);
        $customer_id = $pdo->lastInsertId(); // 挿入されたIDを取得

        // orders テーブルに注文情報を挿入
        $total_price = 0;
        foreach ($_SESSION['cart'] as $item) {
            $total_price += $item['price'] * $item['quantity'];
        }
        $stmt = $pdo->prepare('INSERT INTO orders (customer_id, total_price) VALUES (?, ?)');
        $stmt->execute([$customer_id, $total_price]);
        $order_id = $pdo->lastInsertId();

        // cart_items テーブルにカート内容を挿入
        foreach ($_SESSION['cart'] as $item) {
            $subtotal = $item['price'] * $item['quantity'];
            $stmt = $pdo->prepare('INSERT INTO cart_items (order_id, product_name, price, quantity, subtotal) VALUES (?, ?, ?, ?, ?)');
            $stmt->execute([$order_id, $item['product_name'], $item['price'], $item['quantity'], $subtotal]);
        }

        // トランザクションをコミット
        $pdo->commit();

        // カートをクリア
        unset($_SESSION['cart']);

        // 完了メッセージを表示
        echo "注文が完了しました！";
        echo "<a href='index.php'>ホームに戻る</a>";
    } catch (Exception $e) {
        // エラーが発生した場合はロールバック
        $pdo->rollBack();
        echo "エラーが発生しました: " . $e->getMessage();
    }
}
?>



    </div>

    <script src="./js/script.js"></script>
</body>

</html>