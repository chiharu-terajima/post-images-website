<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>6-2 編集情報確認画面</title>
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
<h1>編集情報確認画面</h1>
<?php
session_start();
$user_id=$_SESSION["user_data"]["user_id"];
$user_name=$_SESSION["editdata"]["user_name"];
$mail=$_SESSION["editdata"]["mail"];
$password=$_SESSION["editdata"]["password"];
?>
入力データをご確認ください。以下の情報でよろしければ「確定」ボタンを押してください<br>
<br>
お名前        :<?php echo $user_name ?> <br>
メールアドレス:<?php echo $mail ?> <br>
パスワード    :<?php echo $password ?> <br>
<br>  
<form action="" method="post">
    <input type="submit" name="submit2" value="戻る">
    <input type="submit" name="submit" value="確定">
</form>

<?php
//確定ボタンが押されたらデータベースを編集
if(isset($_POST["submit"])){
    // DB接続設定
    require("6-2dbconnect.php");
    //よく分からないがこのままだと$user_idが列名だと勘違いされてエラーが出る？
    $sql="UPDATE tb62users SET user_name=:user_name, mail=:mail, password=:password WHERE user_id=:id";
        $stmt=$pdo->prepare($sql);
        $stmt->bindParam(":user_name",$user_name,PDO::PARAM_STR);
        $stmt->bindParam(":mail",$mail,PDO::PARAM_STR);
        $stmt->bindParam(":password",$password,PDO::PARAM_STR);
        $stmt->bindParam(":id",$user_id,PDO::PARAM_STR);
        $stmt->execute();
    //sessionは破棄
    unset($_SESSION["user_data"]);
    unset($_SESSION["editdata"]);
    //sessionの更新　　session自体を更新することができるのかはよく分からなかった。ここでは一度削除して再度作成する。
    $_SESSION["user_data"]["user_id"]=$user_id;
    $_SESSION["user_data"]["user_name"]=$user_name;
    $_SESSION["user_data"]["mail"]=$mail;
    $_SESSION["user_data"]["password"]=$password;
    //次のページに遷移
    header("location:6-2editthank.php");

//戻るボタンが押されたらsessionを破棄して前のページに戻る
}elseif(isset($_POST["submit2"])){
    unset($_SESSION["editdata"]);
    header("location:6-2userdata_edit.php");
}
  ?>
  
</div>
</article>
</body>
</html>