<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>✦ 警告：偵測到危險交易 ✦</title>
    <style>
        /* 全域手遊暗色系漸層背景 */
        body {
            background: radial-gradient(circle at center, #241938 0%, #0d0a16 100%);
            color: #e2e1e6;
            font-family: "Microsoft JhengHei", sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh; /* 讓內容垂直居中 */
        }

        /* 霓虹警告標題 */
        h1 {
            color: #ff4a82;
            font-size: 32px;
            letter-spacing: 3px;
            text-shadow: 0 0 15px #ff4a82;
            margin-bottom: 5px;
        }

        h3 {
            color: #bfa6ff;
            font-size: 18px;
            font-weight: normal;
            margin-bottom: 30px;
            letter-spacing: 1px;
        }

        /* 🟢 中央圖片容器與霓虹邊框特效 */
        .image-container {
            position: relative;
            background: rgba(25, 20, 38, 0.6);
            padding: 15px;
            border-radius: 16px;
            border: 2px solid #ff4a82; /* 螢光粉邊框 */
            box-shadow: 0 0 25px rgba(255, 74, 130, 0.4),  /* 外發光 */
                        inset 0 0 15px rgba(255, 74, 130, 0.2); /* 內發光 */
            max-width: 90%;
            margin-bottom: 40px;
            backdrop-filter: blur(5px);
        }

        /* 限制中央圖片大小與美化 */
        .center-img {
            display: block;
            max-width: 500px; /* 最大寬度限制，可自行調整 */
            width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.6);
        }

        /* 傳送/返回按鈕 */
        .btn-back {
            background: rgba(0, 255, 204, 0.1);
            color: #00ffcc;
            text-decoration: none;
            border: 2px solid #00ffcc;
            padding: 12px 35px;
            font-size: 16px;
            font-weight: bold;
            letter-spacing: 2px;
            border-radius: 30px;
            box-shadow: 0 0 15px rgba(0, 255, 204, 0.2);
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            background: #00ffcc;
            color: #0d0a16;
            box-shadow: 0 0 25px #00ffcc;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

    <h1>✦ 訂單$(]:)."$. ✦</h1>
    <h3>交易失敗！阿哈警告</h3>

    <div class="image-container">
        <img class="center-img" src="阿哈.jpg" alt="彩蛋主視覺圖">
    </div>

    <a href="2.html" class="btn-back">返回首頁</a>
    <br/>
    <a href="7.php" class="btn-back">返回購物車</a>

</body>
</html>