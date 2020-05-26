<?php

namespace Spac\src\controller;

use Spac\config\Parameter;

class BackController extends Controller
{
   
    /*-------
    Update and change password With an Ajax Call
    ---------*/
    public function updatePassword(Parameter $post)
    {
        $response = array('validationpass'=>'', 'validationsamepass'=>'', 'isSuccess'=>false);
            if($post->get('password') && $post->get('samePassword')) {
                 $errors = $this->validation->validate($post, 'updatePassword');
                 $response['validationpass']= $errors;
                if($post->get('password')!= $post->get('samePassword')){
                    $errors = 'Mot de passe non identique';
                    $response['validationpass'] = $errors;
                }
                if(!$errors){
                    $this->userDAO->updatePassword($post, $this->session->get('mail'));
                    $response['isSuccess'] = true;
                }
                
            }else {
                $response['validationpass'] = 'Veuillez remplir tous les champs avec minimum 2 characteres';
            } 
            echo json_encode($response);
    }
}