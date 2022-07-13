<?php

//connectクラスを親クラスとして継承
class QueryArticle extends connect
{
    private $article;

    //インスタンスが生成されると一にコンストラクトが呼ばれ、親クラスのコンストラクタを実行する
    public function __construct()
    {
        parent::__construct();
    }

    //Articleクラスのインスタンスを受け取ったら自身のパラメータとして保持する
    public function setArticle(Article $article)
    {
        $this->article = $article;
    }

    //保持している$articleにIDがあれば上書きを、なければ新規作成する
    public function save()
    {
        if ($this->article->getId()) {

        } else {
            $title = $this->article->getTitle();
            $body = $this->article->getBody();
            $stmt = $this->dbh->prepare("INSERT INTO articles (title, body, created_at, updated_at)
                VALUES (:title, :body, NOW(), NOW())");
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':body', $body, PDO::PARAM_STR);
            $stmt->execute();
        }
    }
}