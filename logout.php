<?php
//セッションをスタート
session_start();
//ログインしているかを確認
if (isset($_SESSION['id'])){
    //ログインしていたら$_SESSION['id']を削除
    //unset()は引数の変数を破棄する関数
    unset($_SESSION['id']);
}
header("Location:login.php");