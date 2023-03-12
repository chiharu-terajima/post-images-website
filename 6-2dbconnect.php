<?php
$dsn = 'データベース名';
$user = 'ユーザー名';
$dbpassword = 'パスワード';
$pdo = new PDO($dsn, $user, $dbpassword, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
?>