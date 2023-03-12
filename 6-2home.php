<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>6-2 新着投稿</title>
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
<h1>ホーム</h1>
<?php
// DB接続設定
require("6-2dbconnect.php");
?>
<hr>
<h2>検索機能</h2>
<form action="" method="post">
    <input type="text" name="keyword" placeholder="キーワードを入力"> 
    <input type="submit" name="submit" value="検索">
</form>
<?php
if(isset($_POST["submit"])){
    $keyword="%".$_POST["keyword"]."%";
    $sql="SELECT * FROM tb62images where title like :keyword or comment like :keyword order by file_id desc";
    $stmt=$pdo->prepare($sql);
    $stmt->bindParam(":keyword",$keyword,PDO::PARAM_STR);
    $stmt->execute();
    $results=$stmt->fetchall();
    echo "検索ワード：".$_POST["keyword"];
    foreach($results as $row){
        echo "<hr>";
        echo "タイトル：".$row["title"]."  /  ";
        echo "コメント：".$row["comment"]."  /  ";
        $user_id=$row["user_id"];
            $sql="SELECT * FROM tb62users where user_id=:user_id";
            $stmt=$pdo->prepare($sql);
            $stmt->bindParam(":user_id",$user_id,PDO::PARAM_STR);
            $stmt->execute();
            $user=$stmt->fetch();
            echo "投稿者：".$user["user_name"]."  /  ";
        echo $row["post_time"]."  /  ";
        echo "(".$row["update_time"].")"."<br>";
        ?>
        <img src="<?php echo $row["file_path"];?>" height="300">
<?php
    }
}else{ ?>
<hr>
<h2>新着投稿一覧</h2>
<?php
//ASC 昇順　DESC　降順
$sql="SELECT * FROM tb62images ORDER BY file_id DESC";
$stmt=$pdo->query($sql);
$results=$stmt->fetchAll();
foreach($results as $row){
    echo "<hr>";
    echo "タイトル：".$row["title"]."  /  ";
    echo "コメント：".$row["comment"]."  /  ";
    $user_id=$row["user_id"];
        $sql="SELECT * FROM tb62users where user_id=:user_id";
        $stmt=$pdo->prepare($sql);
        $stmt->bindParam(":user_id",$user_id,PDO::PARAM_STR);
        $stmt->execute();
        $user=$stmt->fetch();
        echo "投稿者：".$user["user_name"]."  /  ";
    echo $row["post_time"]."  /  ";
    echo "(".$row["update_time"].")"."<br>";
    ?>
    <img src="<?php echo $row["file_path"];?>" height="300">
<?php
}
}?>

</div>
</article>

</body>
</html>