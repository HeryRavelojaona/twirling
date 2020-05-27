<?php

namespace Spac\src\model;

class Article
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $userId;

     /**
     * @var int
     */
    private $categoryId;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $content;

 
    /**
     * @var \DateTime
     */
    private $created_at;

     /**
     * @var int
     */
    private $status;

     /**
     * @var string
     */
    private $filename;
    /**
     * @return string
     */
    public function getFileName()
    {
        return $this->filename;
    }

    /**
     * @param string $filename
     */
    public function setFileName($filename)
    {
        $this->filename = $filename;
    }

     /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param int $id
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }
      /**
     * @return int
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * @param int $id
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
    }


    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }
}