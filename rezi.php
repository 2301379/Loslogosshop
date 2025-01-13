<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ホーム画面(ゲスト)</title>
    <link rel="stylesheet" href="cart.css">
</head>

<body>
    <div class="container">
        <div class="top-bar">
            <a href="index.html">
                <span class="site-title">𝓛𝓸𝓼𝓵𝓸𝓰𝓸𝓼</span>
            </a>
        </div>
        <?php
        session_start();
        $total = 0;

        // 商品削除機能
        if (isset($_GET['remove_id'])) {
            $remove_id = $_GET['remove_id'];
            foreach ($_SESSION['cart'] as $key => $item) {
                if ($item['product_id'] == $remove_id) {
                    unset($_SESSION['cart'][$key]);
                    break;
                }
            }
            $_SESSION['cart'] = array_values($_SESSION['cart']);  // 配列のインデックスを再整理
        }

        // カートが空の場合のメッセージ
        if (empty($_SESSION['cart'])) {
            echo "<p>カートは空です。</p>";
        } else {
            echo "<h1>カートの中身</h1>";
            echo "<table border='1'>";
            echo "<thead>";
            echo "<tr><th>商品名</th><th>価格</th><th>数量</th><th>小計</th></tr>";
            echo "</thead>";
            echo "<tbody>";

            // カート内のアイテムを表示
            foreach ($_SESSION['cart'] as $item) {
                $subtotal = $item['price'] * $item['quantity'];
                $total += $subtotal;

                echo "<tr>";
                echo "<td>{$item['product_name']}</td>";
                echo "<td>{$item['price']}円</td>";
                echo "<td>{$item['quantity']}</td>";
                echo "<td>{$subtotal}円</td>";

                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";

            // 合計金額の表示
            echo "<h2>合計: {$total}円</h2>";
        }
        // 商品削除処理後のリダイレクト
        if (isset($_GET['remove_id'])) {
            $remove_id = filter_var($_GET['remove_id'], FILTER_SANITIZE_NUMBER_INT); // 入力値のサニタイズ
            foreach ($_SESSION['cart'] as $key => $item) {
                if ($item['product_id'] == $remove_id) {
                    unset($_SESSION['cart'][$key]);
                    break;
                }
            }
            $_SESSION['cart'] = array_values($_SESSION['cart']);  // 配列のインデックスを再整理

            // 商品削除後にリダイレクト
            header("Location: cart_view.php"); // リダイレクトでページ更新
            exit;
        }

        ?>
        <h1>購入者情報登録欄</h1>
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
            <div class="back-button-container">
            <button type="submit" class="back-button">支払いへ進む</button>
        </form>



        
    
        </div>



    </div>
</body>

</html>