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

<h1>新規投稿画面</h1>
画像を選択し、送信ボタンを押してください。<br>
<hr>

<?php
// DB接続設定
require("6-2dbconnect.php");
session_start();

if(isset($_SESSION["user_data"])){
if(isset($_POST["upload"])){
    //まずファイルの存在を確認し、かつそれが画像ファイルかどうか（その後画像形式を）確認する　exif_imagetypeはパスを指定する 同じ階層だからファイル名だけ書く
    if(!empty($_FILES["upload_image"]) && exif_imagetype($_FILES["upload_image"]["tmp_name"])){
        //ファイル名の重複防止＆悪意あるファイル名で投稿されても大丈夫なように、ユニークなファイル名を取得しそれに拡張子をつける pathinfo関数でもいけるらしい
        //「.=」は左辺に右辺を追加したものを返す strrchr(第一引数：文字列、第二引数：これ以降の文字列を取得するという目印)
        $filename=uniqid(mt_rand(),true).strrchr($_FILES["upload_image"]["name"],".");
        //これをさらにsubstrでくくる必要がわからないのでやらない。

        //ディレクトリに画像を保存 move_uploaded_file（第1引数：仮のファイル名,　第2引数：格納後のディレクトリ/ファイル名）
        //パスの書き方　一つ下の階層にあるファイルの場合は、「./フォルダ名/ファイル名」
        move_uploaded_file($_FILES["upload_image"]["tmp_name"],"./images/".$filename);

        //データベースに画像のファイル名を保存
        if(!empty($_POST["title"])){$title=($_POST["title"]);}
        if(!empty($_POST["comment"])){$comment=($_POST["comment"]);}
        $file_path="./images/".$filename;

        $sql=$pdo->prepare("INSERT INTO tb62images (user_id,file_name,file_path,title,comment,post_time) 
        VALUES (:user_id,:file_name,:file_path,:title,:comment,cast(now()as datetime))");
         $sql->bindParam(":user_id",$_SESSION["user_data"]["user_id"],PDO::PARAM_STR);       
        $sql->bindParam(":file_name",$filename,PDO::PARAM_STR);
        $sql->bindParam(":file_path",$file_path,PDO::PARAM_STR);
        $sql->bindParam(":title",$title,PDO::PARAM_STR);
        $sql->bindParam(":comment",$comment,PDO::PARAM_STR);
        $sql->execute();
        echo "新規投稿が完了しました<br><br>";

        //表示機能　まず表示したい投稿のファイル名を取り出す。

        //取り出したファイル名を使って表示するファイルのパスを書く。

    }else{
        echo "アップロードする画像ファイルを選択してください<br>";
    }
}elseif(isset($_POST["submit2"])){
    header("Location:6-2mypage.php");
    exit();
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="upload_image"><br>
    <input type="text" name="title" placeholder="タイトル"><br>
    <input type="textbox" name="comment" placeholder="コメント"><br>
    <input type="submit" name="upload" value="送信"><br><br>
    <input type="submit" name="submit2" value="マイページに戻る"><br><br>
</form>

<?php }else{ ?>
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
