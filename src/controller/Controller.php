<?php

namespace Spac\src\controller;

use Spac\config\Request;
use Spac\src\model\View;

abstract class Controller
{
    
    protected $view;
    private $request;
    protected $session;

    public function __construct()
    {   
        $this->request = new Request();
        $this->view = new View();
        $this->session = $this->request->getSession();
        
    }
}