<?php
$products = [
    [
        "id"       => "會客室",
        "category" => "亞克力立牌",
        "variants" => [
            [
                "name"  => "斯科特",
                "price" => 32,
                "image" => "44.jpg"
            ],
            [
                "name"  => "觀景車廂場景",
                "price" => 48,
                "image" => "車廂.jpg"
            ]
        ]
    ],
    [
        "id"       => "會客室",
        "category" => "馬口鐵徽章",
        "variants" => [
            [
                "name"  => "斯科特",
                "price" => 30,
                "image" => "45.jpg"
            ]
        ]
    ],
    [
        "id"       => "星空的預言集",
        "category" => "馬口鐵徽章",
        "variants" => [
            [
                "name"  => "阿哈",
                "price" => 15,
                "image" => "aha.jpg"
            ]
        ]
    ],
    [
        "id"       => "新鮮的肝",
        "category" => "人體",
        "variants" => [
            [
                "name"  => "我",
                "price" => 990000,
                "image" => "阿哈.jpg"
            ],
            [
                "name"  => "你",
                "price" => 990000,
                "image" => "阿哈3.jpg"
            ],
            [
                "name"  => "他",
                "price" => 990000,
                "image" => "阿哈5.jpg"
            ]
        ]
    ]
];
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>線上購物商品目錄</title>
    <style>
        /* 🟢 全域樣式：改為手遊暗黑風格背景 */
        body {
            background: radial-gradient(circle at center, #241938 0%, #0d0a16 100%);
            color: #e2e1e6;
            font-family: "Microsoft JhengHei", sans-serif;
            margin: 0;
            padding: 40px 20px;
        }
        h2 {
            color: #ffffff;
            font-size: 28px;
            letter-spacing: 2px;
            text-shadow: 0 0 10px #ab72ff;
            margin-bottom: 30px;
        }
        /* 🟢 表格美化：玻璃擬態半透明質感 */
        table {
            width: 85%;
            max-width: 1000px;
            margin: 0 auto;
            border-collapse: collapse;
            background: rgba(25, 20, 38, 0.75);
            backdrop-filter: blur(10px);
            border: 1px solid #3d2f5c;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
        }
        th {
            background-color: rgba(61, 47, 92, 0.6);
            color: #d1bfff;
            padding: 14px;
            font-weight: bold;
            letter-spacing: 1px;
            border-bottom: 2px solid #5a4585;
        }
        td {
            padding: 16px;
            border-bottom: 1px solid rgba(88, 70, 128, 0.2);
            color: #ffffff;
        }
        tr:hover {
            background-color: rgba(255, 255, 255, 0.03);
        }
        /* 🟢 商品圖片 */
        .prod-img {
            width: 75px;
            height: auto;
            display: block;
            margin: auto;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.5);
            border: 1px solid rgba(255,255,255,0.1);
            transition: transform 0.2s;
        }
        .prod-img:hover {
            transform: scale(1.05);
        }
        /* 🟢 下拉選單樣式 */
        select {
            background-color: #1b1429;
            color: #ffffff;
            border: 1px solid #5a4585;
            padding: 6px 12px;
            border-radius: 6px;
            outline: none;
            cursor: pointer;
        }
        select:focus {
            border-color: #a370ff;
            box-shadow: 0 0 5px rgba(163, 112, 255, 0.5);
        }
        /* 🟢 放入購物車按鈕：螢光綠/青色科技感 */
        .btn-cart {
            color: #00ffcc;
            text-decoration: none;
            font-weight: bold;
            padding: 6px 12px;
            border: 1px solid #00ffcc;
            border-radius: 20px;
            background: rgba(0, 255, 204, 0.05);
            transition: all 0.3s ease;
        }
        .btn-cart:hover {
            background: #00ffcc;
            color: #0d0a16;
            box-shadow: 0 0 12px #00ffcc;
        }
        .price-text {
            color: #ffcc00;
            font-weight: bold;
        }
    </style>
    <script>
    function switchVariant(selectElement, rowIndex) {
        var selectedOption = selectElement.options[selectElement.selectedIndex];
        var name = selectedOption.value;
        var price = selectedOption.getAttribute('data-price');
        var image = selectedOption.getAttribute('data-image');
        var id = selectedOption.getAttribute('data-id');
        var cat = selectedOption.getAttribute('data-cat');

        document.getElementById('img_' + rowIndex).src = image;
        document.getElementById('img_' + rowIndex).alt = name;
        document.getElementById('price_' + rowIndex).innerText = '$' + Number(price).toLocaleString();
        
        var cookieKey = encodeURIComponent(id + "_" + name);
        var newLink = "7.php?CookieKey=" + cookieKey + 
                      "&ID=" + encodeURIComponent(id) + 
                      "&Name=" + encodeURIComponent(name) + 
                      "&Price=" + price + 
                      "&Category=" + encodeURIComponent(cat) + 
                      "&Image=" + encodeURIComponent(image) + 
                      "&Quantity=1";
                      
        document.getElementById('link_' + rowIndex).href = newLink;
    }
    </script>
</head>
<body>

<h2 align="center">✦ 線上購物商品目錄 ✦</h2>

<table align="center">
  <tr>
    <th>商品圖片</th>
    <th>商品系列</th>
    <th>商品名稱 (款式切換)</th>
    <th>價格</th>
    <th>分類</th>
    <th>操作</th>
  </tr>
  
  <?php
  $rowIndex = 0;
  foreach ($products as $item) {
      $rowIndex++;
      $defaultVariant = $item['variants'][0];
      $id = $item['id'];
      $cat = $item['category'];
      
      $defName = $defaultVariant['name'];
      $defPrice = $defaultVariant['price'];
      $defImage = $defaultVariant['image'];

      $cookieKey = urlencode($id . "_" . $defName);
      $initLink = "7.php?CookieKey={$cookieKey}&ID={$id}&Name=".urlencode($defName)."&Price={$defPrice}&Category=".urlencode($cat)."&Image=".urlencode($defImage)."&Quantity=1";
  ?>
      <tr align="center">
        <td><img id="img_<?php echo $rowIndex; ?>" class="prod-img" src="<?php echo $defImage; ?>" alt="<?php echo $defName; ?>"></td>
        <td style="color: #bfa6ff;"><?php echo $id; ?></td>
        <td>
            <select onchange="switchVariant(this, <?php echo $rowIndex; ?>)">
                <?php foreach ($item['variants'] as $v) { ?>
                    <option value="<?php echo $v['name']; ?>" 
                            data-id="<?php echo $id; ?>" 
                            data-cat="<?php echo $cat; ?>" 
                            data-price="<?php echo $v['price']; ?>" 
                            data-image="<?php echo $v['image']; ?>">
                        <?php echo $v['name']; ?>
                    </option>
                <?php } ?>
            </select>
        </td>
        <td id="price_<?php echo $rowIndex; ?>" class="price-text">$<?php echo number_format($defPrice); ?></td>
        <td><?php echo $cat; ?></td>
        <td><a id="link_<?php echo $rowIndex; ?>" class="btn-cart" href="<?php echo $initLink; ?>">🛒 放入購物車</a></td>
      </tr>
  <?php
  }
  ?>
</table>

</body>
</html>