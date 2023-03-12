<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>6-2 サイト説明</title>
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
<h1>このサイトについて</h1>
<h2>サイトの目的</h2>
暖かい時期になると自然公園や山に花見に行くことが増えますが、行ってみるとまだつぼみばかりだったり、満開の状況ではなかったという経験はありませんか？<br>
サイト制作者はこれを課題として捉え、花見に行きたい人が、直近の開花状況を写真で確認できるwebサイトを作ろうと思いました。それがこのサイトです。<br>
イメージは飲食店の口コミサイトの山・公園バージョンとなります。<br>
<br>
メインターゲット：春・秋に行楽地に出かけたい人（親子連れ・高齢者・若者の順）。<br>
ユーザー数：春頃にユーザー数が増え、月間六百人となる想定で作りました。<br>
製作期間：約一か月<br>
<br>
<h2>使い方</h2>
閲覧だけならログインしなくても可能です。メニューバーの「ホーム」から他人の投稿を新着順で見ることが出来ます。<br>
画像を投稿したい場合はメニューバーの「ログイン」から新規登録画面に移動し、アカウントを作成した上で「新規投稿」から投稿してください。

</div>
</article>
</body>
</html>