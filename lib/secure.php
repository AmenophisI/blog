<?php
//ログインしているかどうかをセッションを使って判断する
//セッション開始
session_start();
//ログイン時に$_SESSION['id']にユーザIDを入れるため、
//セッション配列のidというキーに対して値がnullの場合、ログインしていないので、login.phpに遷移させる
if (!isset($_SESSION['id'])) {
    header('Location:login.php');
}