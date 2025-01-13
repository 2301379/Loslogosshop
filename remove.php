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

        // GETパラメータの確認
        if (!isset($_GET['product_id']) || empty($_GET['product_id'])) {
            echo "商品IDが指定されていません。";
            exit;
        }

        // 商品IDを取得
        $product_id = $_GET['product_id'];

        // カートから商品を削除
        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $key => $item) {
                if ($item['product_id'] === $product_id) {
                    unset($_SESSION['cart'][$key]);
                    break;
                }
            }
            // カートのキーをリセット（再配列）
            $_SESSION['cart'] = array_values($_SESSION['cart']);
        }

        // メッセージを表示
        echo "商品を削除しました！<br>";
        print_r($_SESSION['cart']);
        ?>



    </div>
</body>

</html>