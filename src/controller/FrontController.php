<?php

namespace Spac\src\controller;

use Spac\config\Parameter;


class FrontController extends Controller
{

    public function home()
    {
        
        return $this->view->render('home');
        
    }

    public function login($post)
    {
        if($post->get('submit')) {
            
        }
        return $this->view->render('login');
        
    }
}