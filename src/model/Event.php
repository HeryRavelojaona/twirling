<?php

namespace Spac\src\model;

class Event
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
    private $address;

    /**
    * @var string
    */
    private $place;

    /**
    * @var time
    */
    private $date_start;

    /**
    * @var time
    */
    private $date_end;

    /**
    * @var string
    */
    private $comment;

    /**
    * @var string
    */
    private $filename;

    /**
    * @var int
    */
    private $status;

    /**
    * @return int
    */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
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
     * @param string $userId
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
     * @param string $categoryId
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
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
    * @return string
    */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * @param string $place
     */
    public function setPlace($place)
    {
        $this->place = $place;
    }

    /**
    * @return time
    */
    public function getDateStart()
    {
        return $this->date_start;
    }

    /**
     * @param string $date_start
     */
    public function setDateStart($date_start)
    {
        $this->date_start= $date_start;
    }

    /**
    * @return time
    */
    public function getDateEnd()
    {
        return $this->date_end;
    }

    /**
     * @param string $date_end
     */
    public function setDateEnd($date_end)
    {
        $this->date_end = $date_end;
    }

    /**
    * @return string
    */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

     /**
    * @return string
    */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @param string $filename
     */
    public function setFilename($filename)
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
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

}