<?php
// DB接続設定
require("6-2dbconnect.php");

//CREATE文：データベース内にテーブルを作成 charは文字型、varcharは可変長文字型
echo "tb62users<br>";
$sql="CREATE TABLE IF NOT EXISTS tb62users"
." ("
. "user_id INT AUTO_INCREMENT PRIMARY KEY,"
. "user_name char(32),"
. "mail varchar(255),"
. "password char(32)"
.");";
$stmt=$pdo->query($sql);

//SELECT文：入力したデータレコードを抽出、表示
$sql="SELECT * FROM tb62users";
$stmt=$pdo->query($sql);
$results=$stmt->fetchAll();
foreach($results as $row){
    echo $row["user_id"]."<>";
    echo $row["user_name"]."<>";
    echo $row["mail"]."<>";
    echo $row["password"]."<br>";
}

/*削除用
$sql = 'DROP TABLE tb62images';
$stmt = $pdo->query($sql); /**/

echo "<hr>tb62images<br>";
$sql="CREATE TABLE IF NOT EXISTS tb62images"
." ("
. "file_id INT AUTO_INCREMENT PRIMARY KEY,"
. "user_id INT,"
. "file_name varchar(255),"
. "file_path varchar(255),"
. "title varchar(32),"
. "comment varchar(255),"
. "post_time datetime,"
. "update_time datetime"
.");";
$stmt=$pdo->query($sql);

$sql="SELECT * FROM tb62images";
$stmt=$pdo->query($sql);
$results=$stmt->fetchAll();
foreach($results as $row){
    echo $row["file_id"]."<>";
    echo $row["user_id"]."<>";
    echo $row["file_name"]."<>";
    echo $row["file_path"]."<>";
    echo $row["title"]."<>";
    echo $row["comment"]."<>";
    echo $row["post_time"]."<>";
    echo $row["update_time"]."<br>";
}

echo "<hr>";
$sql ='SHOW CREATE TABLE tb62images';
$result = $pdo -> query($sql);
foreach ($result as $row){
    echo $row[1];
}
echo "<hr>";
session_start();
var_dump($_SESSION);
?>