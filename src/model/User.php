<?php

namespace Spac\src\model;

class User
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $fileName;

    /**
     * @var string
     */
    private $lastname;

    /**
     * @var string
     */
    private $firstname;

    /**
     * @var string
     */
    private $email;

     /**
     * @var boolean
     */
    private $status;

     /**
     * @var boolean
     */
    private $visible;

    /**
     * @var string
     */
    private $role;

    /**
     * @var string
     */
    private $comment;

    /**
     * @var string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @param int $id
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }

     /**
     * @var string
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
    public function getVisible()
    {
        return $this->visible;
    }

    /**
     * @param int $visible
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastname;
    }

    /**
     * @param string $pseudo
     */
    public function setLastName($lastname)
    {
        $this->lastname = $lastname;
    }

     /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstname;
    }

    /**
     * @param string $pseudo
     */
    public function setFirstName($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

   
    /**
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param string $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $id
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }
}