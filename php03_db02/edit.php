<?php
ini_set("display_errors", 1);
// select.phpの編集ボタンからの受け取り
$id = $_GET["id"];

// db接続
include("funcs.php");
$pdo = db_conn();

//データ登録SQL作成
$sql = "SELECT * FROM gs_bm2_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id',$id,PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//３．データ表示
$values = "";
if($status==false) {
    sql_error($stmt);
}

// 
$row =  $stmt->fetch(); //1行のみ
?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ編集</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
  <style>
        .spinner {
            display: none;
            border: 16px solid black;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            /* width: 120px;
            height: 120px; */
            /*下記はバージョン違い  */

            width: 6em;
            height: 6em;
            margin-top: -3.0em;
            margin-left: -3.0em;
            /* border-radius: 50%;
            border: 0.25em solid #ccc;
            border-top-color: #333; */
            animation: spin 500ms linear infinite;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%); 
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
    <script>
        function showSpinner() {
            document.getElementById("spinner").style.display = "block";
        }
    </script>

</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧へ</a></div>
    </div>
  </nav>
</header>

<!-- Head[End] -->

<!-- Main[Start] -->
<div id="spinner" class="spinner"></div>
<form method="POST" action="update.php" onsubmit="showSpinner()">
  <div class="jumbotron">
  <fieldset>
    <div>
    <legend>編集ページ</legend>
     <label>Title：<input type="text" name="title" value="<?=$row["title"]?>" required></label><br>
     <label>Author：<input type="text" name="auther" value="<?=$row["auther"]?>" required></label><br>
     <label>Jurnal：<input type="text" name="jurnal" value="<?=$row["jurnal"]?>" required></label><br>
     <label>Publication Year：<input type="text" name="pYear" value="<?=$row["pYear"]?>" required></label><br>
     <label>DOI：<input type="text" name="doi" required value="<?=$row["doi"]?>"></label>   国際的識別子DOI（Digital Object Identifier）DOIの前に「https://doi.org/」をつけることでURLとして機能<br>
     <label>Interest level：<select name="level" id="">
        <option hidden>選択し直すこと</option>
        <option value="★☆☆☆☆">★☆☆☆☆</option>
        <option value="★★☆☆☆">★★☆☆☆</option>
        <option value="★★★☆☆">★★★☆☆</option>
        <option value="★★★★☆">★★★★☆</option>
        <option value="★★★★★">★★★★★</option>
     </select></label><br>
     <label>Abstract on Abstract：<br><textArea name="abstract" rows="4" cols="40"><?=$row["abstract"]?></textArea></label><br>
     <input type="hidden" name="id" value="<?=$row["id"]?>">
     <input type="submit" value="送信">
    </div>
  </fieldset>
  </div>
</form>
<!-- Main[End] -->

</body>
</html>

