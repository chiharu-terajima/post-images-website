<?php
session_start();
$name=$_SESSION["userdata"]["name"];
$mail=$_SESSION["userdata"]["mail"];
$password=$_SESSION["userdata"]["password1"];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>6-2 新規登録画面</title>
</head>
<body>
<h1>入力内容確認</h1>
入力データをご確認ください。以下の情報でよろしければ「会員登録」ボタンを押してください<br>
<br>
お名前        :<?php echo $name ?> <br>
メールアドレス:<?php echo $mail ?> <br>
パスワード    :<?php echo $password ?> <br>
<br>  
<form action="" method="post">
    <input type="submit" name="submit2" value="戻る">
    <input type="submit" name="submit" value="会員登録">
</form>

<?php
//確定ボタンが押されたらデータベースに登録
if(isset($_POST["submit"])){
    // DB接続設定
    require("6-2dbconnect.php");

    $sql=$pdo->prepare("INSERT into tb62users (user_name, mail, password) values(:user_name, :mail, :password)");
    $sql->bindParam(":user_name",$name,PDO::PARAM_STR);
    $sql->bindParam(":mail",$mail,PDO::PARAM_STR);
    $sql->bindParam(":password",$password,PDO::PARAM_STR);
    $sql->execute();
    //sessionは破棄
    unset($_SESSION["userdata"]);
    //次のページに遷移
    header("location:6-2thank.php");
//変更ボタンが押されたら前のページに戻る
}elseif(isset($_POST["submit2"])){
  header("location:6-2entry.php");
}
?>

</body>
</html>


