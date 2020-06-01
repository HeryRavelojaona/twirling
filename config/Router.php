<?php

namespace Spac\config;
use Spac\src\controller\FrontController;
use Spac\src\controller\BackController;
use Spac\src\controller\ErrorController;

use Exception;

class Router
{
    private $frontController;
    private $backController;
    private $errorController;
    private $request;

    public function __construct()
    {
        $this->frontController = new FrontController();
        $this->backController = new BackController();
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
                elseif($route === 'actuality'){
                    $this->frontController->actuality($this->request->getGet());
                }
                elseif($route === 'training'){
                    $this->frontController->training();
                }
                elseif($route === 'article'){
                    $this->frontController->article($this->request->getGet());
                }
                elseif($route === 'profile'){
                    $this->frontController->profile();
                }
                elseif($route === 'administration'){
                    $this->backController->admin();
                }
                elseif($route === 'addarticle'){
                    $this->backController->addArticle($this->request->getPost());
                }
                elseif($route === 'addevent'){
                    $this->backController->addEvent($this->request->getPost());
                }
                elseif($route === 'previewarticle'){
                    $this->backController->previewArticle($this->request->getPost());
                }
                elseif($route === 'previewevent'){
                    $this->backController->previewEvent($this->request->getPost());
                }
                elseif($route === 'updatePassword'){
                    $this->backController->updatePassword($this->request->getPost());
                }
                elseif($route === 'logout'){
                    $this->frontController->logout();
                }
                elseif($route === 'fileUpload'){
                    $this->frontController->fileUpload($this->request->getPost());
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