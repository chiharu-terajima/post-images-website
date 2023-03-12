<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>6-2 マイページ画面</title>
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

<div class="content">

<?php
// DB接続設定
require("6-2dbconnect.php");
session_start();
?>
<?php
if(isset($_SESSION["user_data"])){
?>
    <h1><?php
    echo $_SESSION["user_data"]["user_name"];
    ?>のマイページ</h1>
    <hr>
    <h2>ユーザーデータ</h2>
    <?php var_dump($_SESSION["user_data"]);?>

    <?php //ページ移動の処理
    if(isset($_POST["submit1"])){
        header("Location:6-2userdata_edit.php");
        exit();
    }elseif(isset($_POST["submit2"])){
        header("Location:6-2logout.php");
        exit();
    }elseif(isset($_POST["submit3"])){
        header("Location:6-2upload.php");
        exit();
    }
    ?>

    <!--sessionがあるならばページ移動のボタンを表示　if文の中にhtmlを埋め込む時は以下のようにする-->
    <?php if(isset($_SESSION["user_data"])){ ?>
        <p><form action="" method="post">
            <input type="submit" name="submit1" value="ユーザー情報の編集"><br>
            <input type="submit" name="submit2" value="ログアウト"><br><br>
            <input type="submit" name="submit3" value="新規投稿"><br>
        </form></p>
    <?php } ?>

    <hr>
    <h2>過去の投稿一覧</h2>
    <?php
    $user_id=$_SESSION["user_data"]["user_id"];
    $sql="SELECT * FROM tb62images where user_id=:user_id ORDER BY file_id DESC";
    $stmt=$pdo->prepare($sql);
    $stmt->bindParam(":user_id",$user_id,PDO::PARAM_INT);
    $stmt->execute();
    $results=$stmt->fetchAll();
    foreach($results as $row){
        echo "タイトル：".$row["title"]."  /  ";
        echo "コメント：".$row["comment"]."  /  ";
        echo $row["post_time"]."  /  ";
        echo $row["update_time"]."<br>";
        ?>
        <img src="<?php echo $row["file_path"];?>" height="300">
        <hr>
    <?php }

}else{ ?>
    <h1>マイページ</h1>
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

</div>
</article>

</body>
</html>