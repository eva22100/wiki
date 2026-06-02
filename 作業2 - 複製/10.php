<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>✦ 系統提示：物資傳送中 ✦</title>
    <style>
        /* 全域手遊暗色系漸層背景 */
        body {
            background: radial-gradient(circle at center, #1b1c3a 0%, #080711 100%);
            color: #e2e1e6;
            font-family: "Microsoft JhengHei", sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh; /* 讓內容完美垂直居中 */
        }

        /* 螢光青綠/藍色 科技感標題 */
        h1 {
            color: #00ffcc;
            font-size: 30px;
            letter-spacing: 3px;
            text-shadow: 0 0 15px rgba(0, 255, 204, 0.6);
            margin-bottom: 5px;
        }

        h3 {
            color: #8fa0ff;
            font-size: 16px;
            font-weight: normal;
            margin-bottom: 35px;
            letter-spacing: 1px;
        }

        /* 🟢 中央 GIF 圖片容器：換成青綠色科技感霓虹邊框 */
        .gif-container {
            position: relative;
            background: rgba(15, 22, 41, 0.7);
            padding: 15px;
            border-radius: 16px;
            border: 2px solid #00ffcc; /* 螢光青綠邊框 */
            box-shadow: 0 0 30px rgba(0, 255, 204, 0.3),  /* 外發光 */
                        inset 0 0 15px rgba(0, 255, 204, 0.1); /* 內發光 */
            max-width: 90%;
            margin-bottom: 40px;
            backdrop-filter: blur(5px);
            /* 加上一個微微的呼吸燈動畫效果，讓 GIF 容器更有質感 */
            animation: borderGlow 3s infinite alternate;
        }

        /* 限制 GIF 大小與美化 */
        .center-gif {
            display: block;
            max-width: 450px; /* 最大寬度限制 */
            width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.7);
        }

        /* 呼吸燈動畫 讓青光微微閃爍 */
        @keyframes borderGlow {
            0% { box-shadow: 0 0 15px rgba(0, 255, 204, 0.2); }
            100% { box-shadow: 0 0 35px rgba(0, 255, 204, 0.5); }
        }

        /* 下方導覽連結按鈕 */
        .btn-home {
            background: rgba(171, 114, 255, 0.1);
            color: #ab72ff;
            text-decoration: none;
            border: 2px solid #ab72ff;
            padding: 12px 35px;
            font-size: 16px;
            font-weight: bold;
            letter-spacing: 2px;
            border-radius: 30px;
            box-shadow: 0 0 15px rgba(171, 114, 255, 0.2);
            transition: all 0.3s ease;
        }

        .btn-home:hover {
            background: #ab72ff;
            color: #ffffff;
            box-shadow: 0 0 25px #ab72ff;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

    <h1>✦ 訂單成立 ✦</h1>
    <h3>訂單已確認！請在夢裡簽收</h3>

    <div class="gif-container">
        <img class="center-gif" src="貓4.gif" alt="訂單處理中動態圖">
    </div>

    <a href="2.html" class="btn-home">回到首頁</a>
    <br/>
    <a href="7.php" class="btn-home">返回購物車</a>

</body>
</html>