<?php
// データベース接続情報
$host = 'mysql312.phy.lolipop.lan'; // またはIPアドレスを使用
$db = '	LAA1557214-loslogos';
$user = 'LAA1557214';
$pass = 'kurato331';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // フォームからの入力データを取得
    $customer_name = $_POST['name'];
    $total_price = 0; // 合計金額を計算

    // カートの中身を取得（仮でセッションの例）
    session_start();
    $cart = $_SESSION['cart']; // ['product_id' => 数量]の形式

    // 注文データをordersテーブルに登録
    $stmt = $pdo->prepare("INSERT INTO orders (customer_name, total_price) VALUES (:customer_name, :total_price)");
    $stmt->execute([
        ':customer_name' => $customer_name,
        ':total_price' => 0 // 最初は0、後で更新する
    ]);

    // 注文IDを取得
    $order_id = $pdo->lastInsertId();

    // カート内の商品をorder_itemsに登録
    foreach ($cart as $product_id => $quantity) {
        // 商品情報を取得
        $stmt = $pdo->prepare("SELECT price FROM products WHERE id = :product_id");
        $stmt->execute([':product_id' => $product_id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($product) {
            $price = $product['price'];
            $subtotal = $price * $quantity;

            // 注文詳細を登録
            $stmt = $pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity, subtotal) VALUES (:order_id, :product_id, :quantity, :subtotal)");
            $stmt->execute([
                ':order_id' => $order_id,
                ':product_id' => $product_id,
                ':quantity' => $quantity,
                ':subtotal' => $subtotal
            ]);

            // 合計金額を計算
            $total_price += $subtotal;
        }
    }

    // 合計金額を更新
    $stmt = $pdo->prepare("UPDATE orders SET total_price = :total_price WHERE id = :order_id");
    $stmt->execute([
        ':total_price' => $total_price,
        ':order_id' => $order_id
    ]);

    echo "注文が登録されました！";

} catch (PDOException $e) {
    echo "エラー: " . $e->getMessage();
}
