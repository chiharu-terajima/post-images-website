<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>6-2 ログアウト</title>
</head>
<body>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>6-2 ログイン</title>
<link href="6-2.css" rel="stylesheet" type="text/css">
</head>
<body>

<article>
  <div class="side">
    <p>メニュー</p>
<?php
if(isset($_POST["menu1"])){
    header("Location:6-2intro.php");
    exit();
}elseif(isset($_POST["menu2"])){
    header("Location:6-2home.php");
    exit();
}elseif(isset($_POST["menu3"])){
    header("Location:6-2mypage.php");
    exit();
}elseif(isset($_POST["menu4"])){
    header("Location:6-2upload.php");
    exit();
}elseif(isset($_POST["menu5"])){
    header("Location:6-2userdata_edit.php");
    exit();
}elseif(isset($_POST["menu6"])){
    header("Location:6-2login.php");
    exit();
}
?>
<form action="" method="post">
    <input type="submit" name="menu1" value="サイト説明"><br>
    <input type="submit" name="menu2" value="ホーム"><br>
    <input type="submit" name="menu3" value="マイページ"><br>
    <input type="submit" name="menu4" value="新規投稿"><br>
    <input type="submit" name="menu5" value="設定"><br>
    <input type="submit" name="menu6" value="ログイン"><br>
</form>
</div> 
<!--ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー-->
<div class="content">
<h1>ログアウト</h1>

<?php
session_start();
if(isset($_POST["logout"])){
    unset($_SESSION["user_data"]);
    header("Location:6-2login.php");
    exit();
}
?>

ログアウトしますか？<br><br>
<form action="" method="post">
    <input type="submit" name="logout" value="ログアウト">
</form>

</body>
</html>