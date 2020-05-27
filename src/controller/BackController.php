<?php

namespace Spac\src\controller;

use Spac\config\Parameter;

class BackController extends Controller
{
   

    public function admin()
    {
        return $this->view->render('administration');
 
    }

    public function previewArticle($post)
    {
        $response = array('title'=>'', 'content'=>'', 'filepath'=>'','filename'=>'','error'=>'');
        $errors = $this->validation->validate($post, 'article');
        if($errors) {
            if($errors['title']){
                $response['error'] = $errors['title'];
            } else {
                $response['error'] = $errors['content'];
            }
        }
       
        if($post->get('title') && $post->get('content')) {
            if($_FILES['photo']){
                if($_FILES['photo'] && $_FILES['photo'] ["error"] == 0 ){
                    $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
                    $filename = $_FILES["photo"]["name"];
                    $filetype = $_FILES["photo"]["type"];
                    $filesize = $_FILES["photo"]["size"];
    
                    $extension = pathinfo($filename, PATHINFO_EXTENSION);
                    if(!array_key_exists($extension, $allowed)) $response['error'] = "Erreur : Veuillez sélectionner un format de fichier valide.";
                    $maxsize = 5 * 1024 * 1024;
                    if($filesize > $maxsize) $response['error'] = "Error: La taille du fichier est supérieure à la limite autorisée.";
    
                    if(in_array($filetype, $allowed)){
                        // Vérifie si le fichier existe avant de le télécharger.
                        $location = "../public/assets/img/upload/" . $_FILES["photo"]["name"];
                        if(file_exists($location)){
                            $response['error'] = $_FILES["photo"]["name"] . " existe déjà.";
                        } else{
                            move_uploaded_file($_FILES["photo"]["tmp_name"], $location);
                            $response['filepath'] = $location;
                            $response['filename'] = $_FILES["photo"]["name"];
                            /*save name in database*/
                            /*$this->userDAO->uploadPicture($this->session->get('mail'), $filename);
                            echo "Votre fichier a été téléchargé avec succès."; */
                        } 
                    } else{
                        $response['error'] = "Error: Il y a eu un problème de téléchargement de votre fichier. Veuillez réessayer."; 
                    }
                } else{
                    $response['error'] = "Error: Fichier absent ou probleme de fichier";
                }
            }

            $response['title'] = $post->get('title');
            $response['content'] = $post->get('content');
        }
        echo json_encode($response);

    }

    public function addArticle($post)
    {
        /* If $status = 1 article is published else if =0 is save*/
        if($post->get('submit')) {
            $status = 1;
        }
        if($post->get('save')){
            $status = 0;
        } 
        if($post->get('submit') || $post->get('save')){
            $this->articleDAO->addArticle($post, $this->session->get('id'), $status);
            $this->session->set('addarticle','Article bien ajouté');
            header('Location: ../public/index.php?route=administration');
            exit();
        } 
        return $this->view->render('addarticle');

    }


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