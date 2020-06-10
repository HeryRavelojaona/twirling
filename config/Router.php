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
                elseif($route === 'story'){
                    $this->frontController->story();
                }
                elseif($route === 'article'){
                    $this->frontController->article($this->request->getGet());
                }
                elseif($route === 'contact'){
                    $this->frontController->contact($this->request->getPost());
                }
                elseif($route === 'event'){
                    $this->frontController->event($this->request->getGet());
                }
                elseif($route === 'mentionlegale'){
                    $this->frontController->mention();
                }
                elseif($route === 'profile'){
                    $this->backController->profile($this->request->getGet());
                }
                elseif($route === 'administration'){
                    $this->backController->admin();
                }
                elseif($route === 'adduser'){
                    $this->backController->addUser($this->request->getPost(), $this->request->getFiles());
                }
                elseif($route === 'deleteuser'){
                    $this->backController->deleteUser($this->request->getGet());
                }
                elseif($route === 'addarticle'){
                    $this->backController->addArticle($this->request->getPost());
                }
                elseif($route === 'deletearticle'){
                    $this->backController->deleteArticle($this->request->getPost());
                }
                elseif($route === 'updatearticle'){
                    $this->backController->updateArticle($this->request->getPost(), $this->request->getGet() );
                }
                elseif($route === 'addevent'){
                    $this->backController->addEvent($this->request->getPost());
                }
                elseif($route === 'updateevent'){
                    $this->backController->updateEvent($this->request->getPost(), $this->request->getGet() );
                }
                elseif($route === 'deleteevent'){
                    $this->backController->deleteEvent($this->request->getPost());
                }
                elseif($route === 'previewarticle'){
                    $this->backController->previewArticle($this->request->getPost(), $this->request->getFiles());
                }
                elseif($route === 'previewevent'){
                    $this->backController->previewEvent($this->request->getPost());
                }
                elseif($route === 'updatePassword'){
                    $this->backController->updatePassword($this->request->getPost());
                }
                elseif($route === 'publishOrNot'){
                    $this->backController->publishOrNot($this->request->getGet());
                }
                elseif($route === 'logout'){
                    $this->frontController->logout();
                }
                elseif($route === 'fileUpload'){
                    $this->backController->fileUpload($this->request->getPost(), $this->request->getFiles());
                }
                elseif($route === 'changeconfig'){
                    $this->backController->changeConfig($this->request->getPost());
                }
                elseif($route === 'admintraining'){
                    $this->backController->adminTraining();
                }
                elseif($route === 'adminstory'){
                    $this->backController->adminStory();
                }
                elseif($route === 'adminmembers'){
                    $this->backController->adminMembers();
                }
                elseif($route === 'adminconfig'){
                    $this->backController->adminConfig();
                }
                elseif($route === 'contactmembers'){
                    $this->backController->contactMembers($this->request->getPost());
                }
                elseif($route === 'contactuser'){
                    $this->backController->contactUser($this->request->getPost(), $this->request->getGet() );
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