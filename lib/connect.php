<?php

class connect
{
    //DB名
    const DB_NAME = "blog";
    //ホスト
    const HOST = "localhost";
    //ユーザ名
    const USER = "root";
    //パスワード
    const PASS = "root";

    //プロパティ DBに接続した後、そのDBを操作するための情報を代入しておく
    //protectedにすることでそのクラス自身と継承したクラスで参照できる
    protected $dbh;

    //コンスタラクタ インスタンスが作成された時に自動的に実行されるメソッド
    public function __construct()
    {
        //どのホストのどのDBに接続するのかを示す
        $dsn = "mysql:host=" . self::HOST . ";dbname=" . self::DB_NAME . ";charset=utf8mb4";
        try {
            //PDOのインスタンスをクラス変数に格納する
            $this->dbh = new PDO($dsn, self::USER, self::PASS);
        } catch (Exception $e) {
            //Exceptionが発生したら表示して終了
            exit($e->getMessage());
        }
        //DBエラーを表示するモードを設定
        $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    public function query($sql, $param = null)
    {
        //プリアドステートメントを作成し、SQL文を実行する準備をする
        $stmt = $this->dbh->prepare($sql);
        //パラメータを割り当てて実行し、結果セットを返す
        $stmt->execute($param);
        return $stmt;
    }
}