<?php
// DB接続設定
require("6-2dbconnect.php");

//入力されたメールアドレスが　データベースの中にある数
if(isset($_POST["mail"])){$mail=$_POST["mail"];}
$sql="SELECT * FROM tb62users where mail=:mail limit 1";
$stmt=$pdo->prepare($sql);
$stmt->bindParam(":mail",$mail,PDO::PARAM_STR);
$stmt->execute();
$result=$stmt->fetch();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>6-2 新規登録画面</title>
</head>
<body>
<h1>アカウント作成</h1>
下記のフォームに必要事項を入力し、「確認画面へ」ボタンを押してください。
既にアカウントがある方は
<form style="display: inline" action="" method="post">
    <input type="submit" name="submit2" value="こちら"><br>
</form>
<br>
<?php
//確認ボタンが押された時
if(isset($_POST["submit"])){
    //入力情報の不備を検知
    if(empty($_POST["name"]) OR empty($_POST["mail"]) OR empty($_POST["password1"]) OR empty($_POST["password2"]) ){
        echo "エラー：必要項目を入力してください";
    }elseif($_POST["password1"] != $_POST["password2"]){
        echo "エラー：同じパスワードが入力されていません";
    }elseif(!empty($result)){
        echo "エラー：このメールアドレスは既に使用されています";
    }else{//確認画面へ遷移。header関数の前では出力してはいけない 他にform actionの中身を指定して次ページに情報を渡す方法もある
        session_start();
        $_SESSION["userdata"]=$_POST;//フォームの内容をセッションで保存
        header("Location:6-2check.php");
        exit();
    }
}elseif(isset($_POST["submit2"])){
    header("Location:6-2login.php");
    exit();
}
?>
<form action="" method="post">
    <input type="text" name="name" placeholder="ユーザー名" ><br>
    <input type="text" name="mail" placeholder="メールアドレス"><br>
    <input type="text" name="password1" placeholder="パスワード"><br>
    <input type="text" name="password2" placeholder="パスワード（確認用）"><br>
    <input type="submit" name="submit" value="確認画面へ">
</form>


</body>
</html>