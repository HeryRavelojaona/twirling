<?php

namespace Spac\config;
use Spac\src\controller\FrontController;
use Spac\src\controller\ErrorController;

use Exception;

class Router
{
    private $frontController;
    private $errorController;
    private $request;

    public function __construct()
    {
        $this->frontController = new FrontController();
        $this->errorController = new ErrorController();
        $this->request = new Request();
    }

    public function run()
    {  
        $route = $this->request->getGet()->get('route');
        try{
            if(isset($route))
            {
                if($route === 'login'){
                    $this->frontController->login($this->request->getPost());
                }
                elseif($route === 'profile'){
                    $this->frontController->profile();
                }

            }
            else {
                $this->frontController->home();
            }
        }
        catch (Exception $e)
        {
            $this->errorController->errorServer();
        }
    }
}