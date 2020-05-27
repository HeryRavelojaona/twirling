<?php

namespace Spac\src\DAO;

use Spac\config\Parameter;
use Spac\src\model\Article;

class ArticleDAO extends DAO
{
    private function buildObject($row)
    {
        $article = new Article();
        $article->setId($row['id']);
        $article->setTitle($row['title']);
        $article->setContent($row['content']);
        $article->setCreatedAt($row['created_at']);
        $article->setUserId($row['user_id']);
        $article->setCategoryId($row['category_id']);
        $article->setFileName($row['filename']);
        $article->setStatus($row['status']);
        return $article;
    }

    public function addArticle(Parameter $post, $userId, $status)
    {  
        $sql = 'INSERT INTO article (title, content, created_at, user_id,filename,category_id, status) VALUES (:title, :content, NOW(), :user_id, :filename, :category_id, :status )';
        $this->createQuery($sql, 
        ['title'=>$post->get('title'),
         'content'=>$post->get('content'),
         'filename'=>$post->get('filename'),
         'user_id'=>$userId,
         'category_id'=>1,
         'status'=> $status
         ]);
    }

     /**
    * @param int $start sql DESC LIMIT start
    * @param int $limit sql DESC LIMIT end
    * @param boolean $published Publish or not
    */
    public function showLastArticles($start,  $limit, $published = NULL)
    {
        //articles for Front view
        $sql = "SELECT article.id , article.title, article.content,article.status, article.created_at, article.user_id, article.filename, article.category_id FROM article WHERE article.status =1 AND article.category_id =1  ORDER BY article.created_at DESC LIMIT ".$start.",".$limit.""; 

        $result = $this->createQuery($sql);
        $articles = [];
        foreach ($result as $row){
            $articleId = $row['id'];
            $articles[$articleId] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $articles;
    }

    /*Count number articles*/
    public function countArticles()
    {
        $sql = 'SELECT COUNT(id) FROM article WHERE status=1';
        $result = $this->createQuery($sql);
        $countId = $result->fetch();
        $count= $countId['COUNT(id)'];
        $result->closeCursor();
        return $count;
    }

    public function showArticle($articleId)
    {
        $sql = 'SELECT article.id , article.title, article.content,article.filename, article.created_at, article.status, article.user_id, article.category_id FROM article INNER JOIN user ON user.id = article.user_id WHERE article.id = '.$articleId.'';
        $result = $this->createQuery($sql);
        $article = $result->fetch();
        $article = $this->buildObject($article);
        $result->closeCursor();
        return $article;
    }

    public function showArticles($category)
    {
        //for admin
        $sql = "SELECT article.id , article.title, article.content,article.filename, article.created_at, article.status, article.user_id, article.category_id FROM article INNER JOIN user ON user.id = article.user_id  WHERE article.category_id = $category ORDER BY article.created_at DESC";
        
        $result = $this->createQuery($sql);
        $articles = [];
        foreach ($result as $row){
            $articleId = $row['id'];
            $articles[$articleId] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $articles;
    }

}