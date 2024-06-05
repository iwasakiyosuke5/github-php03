<?php
//共通に使う関数を記述

//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}


//DBConnection
function db_conn(){
    try {
        $db_name = "php02_db02";    //データベース名
        $db_id   = "root";      //アカウント名
        $db_pw   = "";          //パスワード：XAMPPはパスワード無し or MAMPはパスワード”root”に修正してください。
        $db_host = "localhost"; //DBホスト
        // $db_name = "gsacademy02_php02_db02s";    //データベース名
        // $db_id   = "";      //アカウント名
        // $db_pw   = "";          //パスワード：XAMPPはパスワード無し or MAMPはパスワード”root”に修正してください。
        // $db_host = "mysql57.gsacademy02.sakura.ne.jp"; //DBホスト
        return new PDO('mysql:dbname='.$db_name.';charset=utf8mb4;host='.$db_host, $db_id, $db_pw);
        // 上記は下記の短縮系
        // $pdo = new PDO('mysql:dbname='.$db_name.';charset=utf8;host='.$db_host, $db_id, $db_pw);
        // return $pdo;

    } catch (PDOException $e) {
        exit('DB Connection Error:'.$e->getMessage());
    }
}

//SQLエラー関数：sql_error($stmt)
function sql_error($stmt){
    $error = $stmt->errorInfo();
    exit("SQLError:".$error[2]);
}


function redirect($file_name){
    header("Location: $file_name");
    exit();
}








?>