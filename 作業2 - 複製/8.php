<?php
// 1. 接收從 7.php 傳過來的商品資料
$ID       = $_GET["ID"];
$Name     = $_GET["Name"];
$Price    = $_GET["Price"];    // 這裡對應商品價格
$Category = $_GET["Category"]; // 這裡對應商品分類 (原本是 Type)

// 2. 將商品資料存入陣列 Cookie，有效時間 1 小時
setcookie($ID."[ID]", $ID, time()+3600);
setcookie($ID."[Name]", $Name, time()+3600);
setcookie($ID."[Price]", $Price, time()+3600);
setcookie($ID."[Category]", $Category, time()+3600); // 這裡同步改成 Category

// 3. 存完後，自動跳轉回商品目錄頁面（7.php）
header("Location: 7.php");
exit; // 建議加上 exit，確保網頁跳轉後後續程式碼立即停止執行
?>