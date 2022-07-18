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
            $id = $this->article->getId();
            $title = $this->article->getTitle();
            $body = $this->article->getBody();
            $stmt = $this->dbh->prepare("UPDATE articles
                SET title=:title, body=:body, updated_at=NOW() WHERE id=:id");
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':body', $body, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
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

    public function find($id)
    {
        $stmt = $this->dbh->prepare("SELECT * FROM articles WHERE id=:id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $article = null;
        if ($result) {
            $article = new Article();
            $article->setId($result['id']);
            $article->setTitle($result['title']);
            $article->setBody($result['body']);
            $article->setCreatedAt($result['created_at']);
            $article->setUpdatedAt($result['updated_at']);
        }
        return $article;
    }

    public function findAll()
    {
        $stmt = $this->dbh->prepare("SELECT * FROM articles ORDER BY id");
        $stmt->execute();
        //結果セット全てを配列として取得
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $articles = [];
        //結果セットの配列が全て$resultsに入っているので、それをArticleクラスのインスタンスにして配列にする
        foreach ($results as $result) {
            $article = new Article();
            $article->setId($result['id']);
            $article->setTitle($result['title']);
            $article->setBody($result['body']);
            $article->setCategoryId($result['category_id']);
            $article->setCreatedAt($result['created_at']);
            $article->setUpdatedAt($result['updated_at']);
            $articles[] = $article;
        }
        return $articles;
    }
}