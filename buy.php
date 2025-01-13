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
            <a href="cart_view.php">
                <button class="cart-btn">🛒</button>
            </a>
        </div>
        <!DOCTYPE html>

        <?php
session_start();

// 商品情報の受け取り
$product_id = $_POST['product_id'];
$product_name = $_POST['product_name'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];

// カートがまだ設定されていない場合、初期化
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// 商品がカートにすでにあるか確認
$found = false;
foreach ($_SESSION['cart'] as &$item) {
    // 商品IDが一致すれば数量を増やす
    if ($item['product_id'] === $product_id) {
        $item['quantity'] += $quantity;
        $found = true;
        break;
    }
}

// 同じ商品がカートにない場合は新しく追加
if (!$found) {
    $_SESSION['cart'][] = [
        'product_id' => $product_id,
        'product_name' => $product_name,
        'price' => $price,
        'quantity' => $quantity
    ];
}

// カートページにリダイレクト
header("Location: cart_view.php");
exit;
?>




    </div>
</body>

</html>


<div class="back-button-container">
    <a href="index.php">
        <button class="back-button">ホームへ戻る</button>
    </a>
</div>
</div>
</body>

</html>