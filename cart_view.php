<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ホーム画面(ゲスト)</title>
    <link rel="stylesheet" href="./css/cart.css">
</head>

<body>
    <div class="container">
        <div class="top-bar">
            <a href="index.php">
                <span class="site-title">𝓛𝓸𝓼𝓵𝓸𝓰𝓸𝓼</span>
            </a>
        </div>
        <?php
        session_start();
        

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
        
        

        if (empty($_SESSION['cart'])) {
            echo "カートが空です。";
            exit;
        }

        try {
            $pdo->beginTransaction(); // トランザクション開始

            // 1. ordersテーブルに新しい注文を挿入
            $stmt = $pdo->prepare("INSERT INTO orders (user_id, total_price) VALUES (:user_id, :total_price)");
            $user_id = null; // ゲストの場合はNULL、ログインシステムがあるなら適切なユーザーIDを設定
            $total_price = array_reduce($_SESSION['cart'], function ($sum, $item) {
                return $sum + $item['price'] * $item['quantity'];
            }, 0);
            $stmt->execute([
                ':user_id' => $user_id,
                ':total_price' => $total_price
            ]);
            $order_id = $pdo->lastInsertId(); // 挿入した注文のIDを取得

            // 2. order_itemsテーブルにカート内の商品を挿入
            $stmt = $pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)");
            foreach ($_SESSION['cart'] as $item) {
                $stmt->execute([
                    ':order_id' => $order_id,
                    ':product_id' => $item['product_id'],
                    ':quantity' => $item['quantity'],
                    ':price' => $item['price']
                ]);
            }

            $pdo->commit(); // トランザクションを確定
            echo "注文が確定しました！";

            // 3. カート情報をリセット
            unset($_SESSION['cart']);
        } catch (Exception $e) {
            $pdo->rollBack(); // トランザクションをロールバック
            echo "注文処理中にエラーが発生しました: " . $e->getMessage();
        }
        ?>


        <div class="back-button-container">
            <a href="index.php">
                <button class="back-button">ホームへ戻る</button>
            </a>
            <a href="rezi.php">
                <button class="back-button">レジに進む</button>
            </a>
        </div>




    </div>
</body>

</html>