<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>6-2 アカウント管理画面</title>
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
    <h1>アカウント管理</h1><hr>
<?php
// DB接続設定
require("6-2dbconnect.php");
session_start();
var_dump($_SESSION);
if(isset($_SESSION["user_data"])){
?>
<!--//sessionの内容を取り出し、確認用に表示-->
<h2>アカウント情報変更</h2>
修正したい項目を編集してください。
<form action="" method="post">
    ユーザー名:
    <input type="text" name="user_name" value="<?php echo $_SESSION["user_data"]["user_name"]?>"><br>
    メールアドレス:
    <input type="text" name="mail" value="<?php echo $_SESSION["user_data"]["mail"]?>"><br>
    パスワード:
    <input type="text" name="password" value="<?php echo $_SESSION["user_data"]["password"]?>"><br>

    <input type="submit" name="submit" value="確認画面へ"><br>
        <?php
        //入力情報の不備を検知するための準備　入力されたメアドが他の人に使われている数
        $user_id=$_SESSION["user_data"]["user_id"];
        if(isset($_POST["mail"])){$mail=$_POST["mail"];}
        $sql="SELECT * FROM tb62users where user_id!=:user_id AND mail=:mail limit 1";
        $stmt=$pdo->prepare($sql);
        $stmt->bindParam(":user_id",$user_id,PDO::PARAM_STR);
        $stmt->bindParam(":mail",$mail,PDO::PARAM_STR);
        $stmt->execute();
        $result2=$stmt->fetch();

        //入力情報の不備を検知　→大丈夫ならデータを保持してページ移動
        if(isset($_POST["submit"])){
            if(empty($_POST["user_name"]) OR empty($_POST["mail"]) OR empty($_POST["password"])){
                echo "エラー：必要項目を入力してください";
            }elseif(!empty($result2)){
                echo "エラー：このメールアドレスは別のアカウントで使用されています";
            }else{
                //編集された名前、メアド、パスワードを保存
                $_SESSION["editdata"]=$_POST;
                header("Location:6-2editcheck.php");
                exit();
            }
        }elseif(isset($_POST["delete"])){
            header("Location:");
            exit();
        }
        ?>

<hr>
<h2>アカウントの削除</h2>
アカウント削除はこちら<br>
    <input type="submit" name="delete" value="アカウント削除">
</form>

<?php }else{ ?>
     <h1>設定</h1>
     ログインしてください。
     <form action="" method="post">
             <input type="submit" name="submit4" value="ログイン画面へ">
     </form>
     <?php
     if(isset($_POST["submit4"])){
         header("Location:6-2login.php");
         exit();
     }
 } ?>
