<?php

namespace Spac\src\controller;

use Spac\config\Request;
use Spac\src\model\View;
use Spac\src\DAO\UserDAO;
use Spac\src\DAO\ArticleDAO;
use Spac\config\Mailing;
use Spac\src\DAO\ConfigDAO;
use Spac\src\DAO\EventDAO;
use Spac\src\constraint\Validation;

abstract class Controller
{
    
    protected $view;
    private $request;
    protected $session;
    protected $userDAO;
    protected $eventDAO;
    protected $configDAO;
    protected $mailing;
    protected $get;
    protected $post;
    protected $validation;

    public function __construct()
    {   
        $this->request = new Request();
        $this->view = new View();
        $this->get = $this->request->getGet();
        $this->post = $this->request->getPost();
        $this->session = $this->request->getSession();
        $this->userDAO = new UserDAO();
        $this->articleDAO = new ArticleDAO();
        $this->eventDAO = new EventDAO();
        $this->configDAO = new ConfigDAO();
        $this->validation = new Validation();
        $this->mailing = new Mailing();
        
    }
}