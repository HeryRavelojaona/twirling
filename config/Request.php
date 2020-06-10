<?php

namespace Spac\config;

class Request
{
    private $get;
    private $post;
    private $session;
    private $files;
   

    public function __construct()
    {
        $this->get = new Parameter($_GET);
        $this->post = new Parameter($_POST);
        $this->files = new Parameter($_FILES);
        $this->session = new Session($_SESSION);
    }

    /**
     * @return Parameter
     */
    public function getGet()
    {
        return $this->get;
    }

    /**
     * @return Parameter
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @return Parameter
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * @return Session
     */
    public function getSession()
    {
        return $this->session;
    }
}