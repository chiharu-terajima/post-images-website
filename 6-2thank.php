<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>6-2 新規登録画面</title>
</head>
<body>
<h1>アカウント作成完了</h1>
アカウント作成が完了しました。ご登録ありがとうございます。
<?php
if(isset($_POST["submit"])){
    header("Location:6-2login.php");
    exit();
}
?>
<form action="" method="post">
    <input type="submit" name="submit" value="ログイン画面へ">
</form>
</body>
</html>