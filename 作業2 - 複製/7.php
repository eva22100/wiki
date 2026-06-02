<?php
if (isset($_GET['CookieKey']) && isset($_GET['ID'])) {
    $cookie_key = $_GET['CookieKey'];
    $id = $_GET['ID'];
    $name = $_GET['Name'];
    $price = $_GET['Price'];
    $cat = $_GET['Category'];
    $img = $_GET['Image'];
    $add_qty = isset($_GET['Quantity']) ? intval($_GET['Quantity']) : 1;

    if (isset($_COOKIE[$cookie_key]['Quantity'])) {
        $add_qty += intval($_COOKIE[$cookie_key]['Quantity']);
    }

    setcookie($cookie_key."[ID]", $id, time() + 86400);
    setcookie($cookie_key."[Name]", $name, time() + 86400);
    setcookie($cookie_key."[Price]", $price, time() + 86400);
    setcookie($cookie_key."[Category]", $cat, time() + 86400);
    setcookie($cookie_key."[Image]", $img, time() + 86400);       
    setcookie($cookie_key."[Quantity]", $add_qty, time() + 86400); 

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

if (isset($_GET['delete_id'])) {
    $del_id = $_GET['delete_id'];
    if (isset($_COOKIE[$del_id]) && is_array($_COOKIE[$del_id])) {
        foreach ($_COOKIE[$del_id] as $key => $value) {
            setcookie($del_id."[$key]", "", time() - 3600);
        }
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

if (isset($_GET['action']) && $_GET['action'] == 'update_qty') {
    $prod_id = $_GET['prod_id'];
    $new_qty = intval($_GET['qty']);
    
    if ($new_qty <= 0) {
        header("Location: " . $_SERVER['PHP_SELF'] . "?delete_id=" . urlencode($prod_id));
        exit;
    }

    if (isset($_COOKIE[$prod_id]) && is_array($_COOKIE[$prod_id])) {
        setcookie($prod_id."[Quantity]", $new_qty, time() + 86400);
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

function each(&$array) {
   $res = array();
   $key = key($array);
   if($key !== null){
       $res[1] = $res['value'] = $array[$key];
       $res[0] = $res['key'] = $key;
       next($array); 
   }else{
       $res = false;
   }
   return $res;
}
?>
<!DOCTYPE html>
<html>  
<head>
<meta charset="utf-8" />
<title>我的購物車</title>
<style>
    /* 全域手遊暗色系 */
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
        text-shadow: 0 0 10px #ff66cc; 
        margin-bottom: 30px;
    }
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
        color: #ffbfff;
        padding: 14px;
        font-weight: bold;
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
    .prod-img {
        width: 60px;
        height: auto;
        display: block;
        margin: auto;
        border-radius: 6px;
        border: 1px solid rgba(255,255,255,0.1);
    }
    select {
        background-color: #1b1429;
        color: #ffffff;
        border: 1px solid #5a4585;
        padding: 4px 8px;
        border-radius: 6px;
    }
    .btn-delete {
        color: #ff4a82;
        text-decoration: none;
        font-weight: bold;
        padding: 4px 10px;
        border: 1px solid #ff4a82;
        border-radius: 14px;
        background: rgba(255, 74, 130, 0.05);
        transition: all 0.2s;
    }
    .btn-delete:hover {
        background: #ff4a82;
        color: #ffffff;
        box-shadow: 0 0 10px #ff4a82;
    }
    .total-row {
        background-color: rgba(255, 204, 0, 0.1) !important;
        color: #ffcc00;
        font-size: 18px;
    }
    .bottom-nav a {
        color: #bfa6ff;
        text-decoration: none;
        margin: 0 15px;
        transition: color 0.2s;
    }
    .bottom-nav a:hover {
        color: #ffffff;
        text-shadow: 0 0 5px #bfa6ff;
    }
    .submit-container {
        text-align: center;
        margin-top: 25px;
    }
    .btn-checkout {
        background: rgba(0, 255, 204, 0.1);
        color: #00ffcc;
        border: 2px solid #00ffcc;
        padding: 12px 40px;
        font-size: 18px;
        font-weight: bold;
        letter-spacing: 2px;
        border-radius: 30px;
        cursor: pointer;
        font-family: inherit;
        box-shadow: 0 0 15px rgba(0, 255, 204, 0.2);
        transition: all 0.3s ease;
    }
    .btn-checkout:hover {
        background: #00ffcc;
        color: #0d0a16;
        box-shadow: 0 0 25px #00ffcc;
        transform: translateY(-2px);
    }
</style>
<script>
function updateQty(prodId, qty) {
    window.location.href = '?action=update_qty&prod_id=' + encodeURIComponent(prodId) + '&qty=' + qty;
}

// 🟢 新增 JavaScript：送出前檢查有沒有出賣「新鮮的肝」
function checkCartBeforeSubmit(event) {
    var form = document.getElementById('cartForm');
    
    // 1. 抓取所有包含商品品名的隱藏欄位陣列，或者直接檢查畫面上所有的商品系列字樣
    var cartTable = document.getElementById('cartTable');
    var tableHTML = cartTable.innerHTML;
    
    // 2. 檢查購物車的內容裡是否有出現「新鮮的肝」或「肝」
    if (tableHTML.includes('新鮮的肝') || tableHTML.includes('肝')) {
        // 如果有賣肝，觸發特別彩蛋，動態改去 11.php
        form.action = '11.php';
    } else {
        // 沒有賣肝，就走正常結帳程序
        form.action = '10.php';
    }
}
</script>
</head>
<body> 

<h2 align="center">🛒 阿哈的購物車</h2>

<form id="cartForm" action="結帳確認.php" method="POST">

<table id="cartTable" align="center">
  <tr align="center">
    <th>功能</th>
    <th>商品圖片</th> 
    <th>商品系列</th>
    <th>商品名稱</th>
    <th>價格</th>
    <th>數量</th>     
    <th>小計</th>     
    <th>分類</th>
  </tr>

<?php
$flag = false;  
$total_price = 0; 
$has_items = false; 

while ( list($arr, $value) = each($_COOKIE) ) {
  if ( isset($_COOKIE[$arr]) && is_array($_COOKIE[$arr]) ) {
     $has_items = true;
     echo "<tr align='center'>";
     echo "<td><a class='btn-delete' href='?delete_id=".urlencode($arr)."'>❌ 刪除</a></td>";
     
     $prod_data = $_COOKIE[$arr];
     $id    = isset($prod_data['ID'])       ? $prod_data['ID'] : '';
     $name  = isset($prod_data['Name'])     ? $prod_data['Name'] : '';
     $price = isset($prod_data['Price'])    ? intval($prod_data['Price']) : 0;
     $qty   = isset($prod_data['Quantity']) ? intval($prod_data['Quantity']) : 1;
     $cat   = isset($prod_data['Category']) ? $prod_data['Category'] : '';
     $img   = isset($prod_data['Image'])    ? $prod_data['Image'] : 'default.jpg';

     $subtotal = $price * $qty;
     $total_price += $subtotal; 

     echo "<td><img class='prod-img' src='{$img}' alt='{$name}'></td>";
     echo "<td style='color: #bfa6ff;'>" . $id . "</td>";
     echo "<td>" . $name . "</td>";
     echo "<td style='color: #ffcc00;'>$" . number_format($price) . "</td>";
     
     echo "<td>";
     echo "<select name='qty' onchange='updateQty(\"".$arr."\", this.value)'>";
     for ($i = 1; $i <= 10; $i++) {
         $selected = ($i == $qty) ? "selected" : "";
         echo "<option value='".$i."' ".$selected.">".$i."</option>";
     }
     echo "</select>";
     echo "</td>";
     
     echo "<td style='color: #ffcc00; font-weight: bold;'>$" . number_format($subtotal) . "</td>";
     echo "<td style='color: #a370ff;'>" . $cat . "</td>";
     echo "</tr>";
  }
}

if ($total_price != 0) {
   echo "<tr class='total-row'><td colspan='8' align='right'>";
   echo "<strong>💵 目前商品總金額 = $" . number_format($total_price) . " 元(人民幣)</strong></td></tr>";
} else {
   echo "<tr bgcolor='transparent'><td colspan='8' style='color: #8c82a6;'>您的購物車目前沒有商品喔！</td></tr>";
}
?>
</table>

<?php 
if ($has_items) { 
?>
    <div class="submit-container">
        <button type="submit" class="btn-checkout" onclick="checkCartBeforeSubmit(event)">✦ 確認送出訂單 ✦</button>
    </div>
<?php 
} 
?>

</form>

<hr style="border: 0; border-top: 1px solid #3d2f5c; margin: 30px 0;"/>
<div class="bottom-nav" align="center">
 | <a href="9.php">繼續購物 (商品目錄)</a>
 | <a href="7.php">重新整理購物車</a> | 
 | <a href="2.html">首頁</a> |
</div>

</body>
</html>