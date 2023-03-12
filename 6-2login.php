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
<h1>ログイン</h1>
<!--ログイン画面　→マイページ　→新規登録画面-->
<!--ログインフォーム-->
アカウント名とパスワードを入力してください。<hr>
<?php
// DB接続設定
require("6-2dbconnect.php");

//ログインボタンが押された場合
if(isset($_POST["submit"])){
    if(!empty($_POST["mail"]) && !empty($_POST["password"])){
        //データ受け取り
        $mail=$_POST["mail"];
        $password=$_POST["password"];
        //パスワード照合
        $sql="SELECT * FROM tb62users where mail=:mail";
        $stmt=$pdo->prepare($sql);
        $stmt->bindParam(":mail",$mail,PDO::PARAM_STR);
        $stmt->execute();
        $result=$stmt->fetch();
        if($result["password"]==$password){
            //合っていたらsessionにユーザーデータ（ID,名前、メアド、パスワード）を保存してマイページに移動
            session_start();
            $_SESSION["user_data"]=$result;
            header("Location:6-2mypage.php");
            exit();
        }else{
            echo "パスワードが違います";
        }
    }else{
        echo "必要事項を入力してください";
    }
//「新規登録はこちら」が押された場合
}elseif(isset($_POST["submit2"])){
    header("Location:6-2entry.php");
        exit();
}
?>

<form action="" method="post">
    <input type="text" name="mail" placeholder="メールアドレス"><br>
    <input type="text" name="password" placeholder="パスワード"><br>
    <input type="submit" name="submit" value="ログイン"><br>
    <br>
    <!--新規登録画面に遷移-->
    <input type="submit" name="submit2" value="新規登録はこちら"><br>
</form>
<br>

</div>
</article>
</body>
</html>