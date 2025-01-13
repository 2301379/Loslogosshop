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
        <div class="content">
            <div class="product-container">
                <div class="product-card">
                    <div class="main-image-container">
                        <img id="main-image" src="pants.jpg"
                            alt="メイン画像">
                    </div>
                    <!-- サムネイル画像 -->
                   
                </div>

                <div class="product-info">
                    <!-- 商品タイトル -->
                    <div class="text">
                        Loslogos pants
                    </div>

                    <form method="post" action="buy.php">
                        <?php
                        $product_id = 800; // 例えば、データベースから取得したID
                        ?>
                        <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product_id); ?>">

                        <input type="hidden" name="product_name" value="Loslogos pants">
                        <input type="hidden" name="price" value="7000">
                        <label>数量: <input type="number" name="quantity" value="1" min="1"></label>
                        <button type="submit">カートに追加</button>
                    </form>


                    <!-- レーティング情報 -->


                    <!-- 価格情報 -->
                    <div class="price"> ¥7,000 税込</div>

                    <!-- 配送情報 -->
                    <div class="offers-info">
                        【受注生産のため、商品の到着はご購入日から約３週間後となります。】
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="./js/script.js"></script>
</body>
</html>