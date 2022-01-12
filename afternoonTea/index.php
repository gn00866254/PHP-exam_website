<?php
require_once("includes/classes/Account.php");
ob_start();
session_start();
try {
    //インスタンスを作成することで接続を確立する。PDO object
    $con = new PDO("mysql:dbname=exam;host=localhost","root","");
    $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
}
catch (PDOException $e){
    //エラーメッセージを出力する。
    exit("エラーが発生しました!!".$e->getMessage());
}

$account= new Account($con);

if (isset($_POST["submitButton"])){
    $user_id = $_POST["student_id"];
    $password = $_POST["student_password"];
    $login_success = $account->login($user_id,$password);

    if($login_success){
        $_SESSION["student_id"]=$user_id;
        header("Location: userinterface_re.php");
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Afternoon Tea</title>
<link rel="stylesheet" type="text/css" href="assets/style/style.css" />
</head>
<body>
    <div class="header">
        <img class="logo" src="assets/images/web_logo.png">
    </div>
    <div class="contents">
        <div class="column">
            <form method="POST">
            <div class="loginArea">
                <?php 
                    if ($account->get_error("ユーザー名またはパスワードが間違いました")){
                        echo "<p class='error_message'>ユーザー名またはパスワードが間違いました</p>";;
                    }else{
                        echo "<p class='title_massage'>ユーザー名とパスワードを入力してください</p>";
                    }
                ?>
                <p>
                <span>Username:</span>
                <input type="text" name="student_id" required>
                </p>    
                <p>
                <span>Password :</span>
                <input type="password" name="student_password" required>
                </p>
            </div>
            <div class="button">
                <input type="submit" name="submitButton" value="ログイン">
            </div>
            </form>
        </div>
    </div>
    
</body>
</html>