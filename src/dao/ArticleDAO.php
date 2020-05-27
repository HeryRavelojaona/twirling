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
        $article->setFileName($row['filename']);
        $article->setStatus($row['status']);
        return $article;
    }

    public function addArticle(Parameter $post, $userId, $status)
    {  
        $sql = 'INSERT INTO article (title, content, created_at, user_id,filename,category_id, status ) VALUES (:title, :content, NOW(), :user_id, :filename, :category_id, :status )';
        $this->createQuery($sql, 
        ['title'=>$post->get('title'),
         'content'=>$post->get('content'),
         'filename'=>$post->get('filename'),
         'user_id'=>$userId,
         'category_id'=>1,
         'status'=> $status
         ]);
    }

}