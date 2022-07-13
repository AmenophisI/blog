<?php

class Article
{
    //articleテーブルと同じパラメータ
    private $id;
    private $title;
    private $body;
    private $category_id;
    private $created_id;
    private $updated_id;

    //save()が呼び出されるとQueryArticleクラスのインスタンスを作成する
    //QueryArticleは実際にテーブルの操作を行なうクラス
    //setArticleメソッドでArticleクラスのインスタンスである自分自身をセットし、保存動作を実行する
    public function save()
    {
        $queryArticle = new QueryArticle();
        $queryArticle->setArticle($this);
        $queryArticle->save();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body): void
    {
        $this->body = $body;
    }

    /**
     * @return mixed
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * @param mixed $category_id
     */
    public function setCategoryId($category_id): void
    {
        $this->category_id = $category_id;
    }

    /**
     * @return mixed
     */
    public function getCreatedId()
    {
        return $this->created_id;
    }

    /**
     * @param mixed $created_id
     */
    public function setCreatedId($created_id): void
    {
        $this->created_id = $created_id;
    }

    /**
     * @return mixed
     */
    public function getUpdatedId()
    {
        return $this->updated_id;
    }

    /**
     * @param mixed $updated_id
     */
    public function setUpdatedId($updated_id): void
    {
        $this->updated_id = $updated_id;
    }
}