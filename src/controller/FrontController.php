<?php

namespace Spac\src\controller;

use Spac\config\Parameter;


class FrontController extends Controller
{

    public function home()
    {
        
        return $this->view->render('home');
        
    }

    public function login(Parameter $post)
    {
        if($post->get('submit')) {
            $errors = $this->validation->validate($post, 'login');
            
            if(!$errors) {
                $result = $this->userDAO->login($post);
                if($result && $result['isPasswordValid']) {
                    $this->session->set('login', 'Bonjour '.$result['result']['lastname'].'');
                    $this->session->set('id', $result['result']['id']);
                    $this->session->set('lastname', $result['result']['lastname']);
                    $this->session->set('mail', $result['result']['email']);
                    $this->session->set('role', $result['result']['role']);
                    header('Location: ../public/index.php');
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

        
}