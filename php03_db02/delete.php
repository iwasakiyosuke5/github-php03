<?php
//1. POSTデータ取得
$ids = $_POST["delete_ids"];

if(empty($ids)){
    exit("一つも選択されていないので削除できません");
}
//2. DB接続します
include("funcs.php");
$pdo = db_conn();


// プレースホルダー生成用のコールバック関数を定義
$placeholder = function($key) {
    return ":id{$key}";
};
// echo $placeholder;
// プレースホルダーを生成
$placeholders = array_map($placeholder, array_keys($ids));
$sql = "DELETE FROM gs_bm2_table WHERE id IN (" . implode(',', $placeholders) . ")";
// 上記でDELETE FROM gs_bm2_table WHERE id IN ("id1,1d3,id4")となるイメージ
$stmt = $pdo->prepare($sql);
// プレースホルダーに値をバインド
foreach ($ids as $index => $id) {
    $stmt->bindValue(":id{$index}", $id, PDO::PARAM_INT);
}
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
    sql_error($stmt);
}else{
    redirect("select.php");
}
?>