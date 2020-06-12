<?php

namespace Spac\src\controller;

use Spac\config\Parameter;

class FrontController extends Controller
{

    public function home()
    {
        /*show users on Team part */
        $visible = 1;
        $team = $this->userDAO->getUsers($visible);
        /**
        * @param boolean $published if the article is published
        * @param int $start sql DESC LIMIT start
        * @param int $limit sql DESC LIMIT end
        */
 
        $published = true;
        $start = 0;
        $limit = 2;
        $articles = $this->articleDAO->showLastArticles( $start, $limit, $published);
        $config = $this->configDAO->getConfig();
        return $this->view->render('home',[
            'articles' => $articles,
            'team' => $team,
            'config' => $config
        ]);
        
    }

    public function mention()
    {
        return $this->view->render('mentionlegale');
    }

    public function article(Parameter $get)
    {
        if(isset($get)){
            $articleId =  $get->get('articleId');
            if(($articleId > 1)){
                $article = $this->articleDAO->showArticle($articleId);

                return $this->view->render('article',[
                    'article' => $article
                ]);
            }
         }
     
         $this->errorController->errorNotFound();
    }

    public function actuality($get)
    {
         // Pagination
         $count =  (int) $this->articleDAO->countArticles();
         $artPerPage = 6;
         $currentPage = 1;
         $nbPage = ceil($count/$artPerPage);
 
         if(isset($get)){
            $page =  $get->get('page');
             if(($page > 0) && ($page <=  $nbPage) )
                 $currentPage = $page;
         }
         /**
         * @param int $start sql DESC LIMIT start
         * @param int $limit sql DESC LIMIT end
         * @param boolean $published if the article is published
         */
         $start = ($currentPage - 1) * $artPerPage;
         $limit = $artPerPage;
 
         $published = true;
         $articles = $this->articleDAO->showLastArticles($start, $limit, $published);
         return $this->view->render('actuality', [
             'articles' => $articles,
             'nbPage' => $nbPage,
             'currentPage' => $currentPage,
             ]);
    }

    public function login(Parameter $post)
    {
        if($post->get('submit')) {
            $errors = $this->validation->validate($post, 'login');
            
            if(!$errors) {
                $result = $this->userDAO->login($post);
                if($result && $result['isPasswordValid']) {
                    $this->session->set('login', 'Bonjour '.$result['result']['firstname'].'');
                    $this->session->set('id', $result['result']['id']);
                    $this->session->set('lastname', $result['result']['lastname']);
                    $this->session->set('firstname', $result['result']['firstname']);
                    $this->session->set('mail', $result['result']['email']);
                    $this->session->set('role', $result['result']['role']);
                    $this->session->set('law', $result['result']['law']);
                    $this->session->set('status', $result['result']['status']);
                    $this->session->set('filename', $result['result']['filename']);
                    header('Location: index.php');
                    exit();
                }
                else {
                    $errors['invalid'] = 'Le pseudo ou le mot de passe sont incorrects';  
                }  
            }
            return $this->view->render('login', [
                'post'=> $post,
                'errors'=> $errors
            ]);

        }
        return $this->view->render('login');
    }

    public function logout()
    {
        $this->session->stop();
        $this->session->start();
        $this->session->set('logout', 'Vous êtes déconnecter');
        header('Location: index.php');
        exit();
    }

    public function training()
    {
        /*Call with category Id training=3*/
        $events = $this->eventDAO->showEvents(3);
        return $this->view->render('training',[
            'events' => $events
        ]);
    }

    public function story()
    {
        /*Call with category Id story=2*/
        $category = 2;
        $stories = $this->articleDAO->showArticles($category, 'ASC');
        return $this->view->render('story',[
            'stories' => $stories
        ]);
    }

    public function event(Parameter $get)
    {
        if($get->get('eventId')){
            $eventId =  $get->get('eventId');
                $event = $this->eventDAO->showEvent($eventId);
                return $this->view->render('event',[
                    'event' => $event
                ]);
        }
     
        $this->errorController->errorNotFound();
    }

    /*contact*/
    public function contact(Parameter $post)
    {     
        if(isset($post)){
             $res = array('success'=>false,'errors'=>'');
        $res['errors']= $this->validation->validate($post, 'contact');
            if(!$res['errors']){
                $res['success']= true;
                $this->mailing->contact($post);
            }
         echo json_encode($res) ;
        };
    }
  
}