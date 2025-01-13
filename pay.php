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

        <!-- 商品リストを表示 -->
        <form action="confirm_purchase.php" method="post">
    <div class="info">
        <div class="info-row">
            <label for="name">名前：</label>
            <input type="text" id="name" name="name" placeholder="名前" required>
        </div>
        <div class="info-row">
            <label for="postal-code">郵便番号：</label>
            <input type="text" id="postal-code" name="postal_code" placeholder="郵便番号" required>
        </div>
        <div class="info-row">
            <label for="address">住所：</label>
            <input type="text" id="address" name="address" placeholder="住所" required>
        </div>
        <div class="info-row">
            <label for="phone">電話番号：</label>
            <input type="text" id="phone" name="phone" placeholder="電話番号" required>
        </div>
        <div class="info-row">
            <label for="email">メールアドレス：</label>
            <input type="email" id="email" name="email" placeholder="メールアドレス" required>
        </div>
    </div>
    
    <button type="submit">購入を確定する</button>
</form>

    </div>

    <script src="./js/script.js"></script>
</body>
</html>