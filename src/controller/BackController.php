<?php

namespace Spac\src\controller;

use Spac\config\Parameter;

class BackController extends Controller
{
   

    public function admin()
    {
        /*$category = 1 if is for actuality*/
        $category = 1;
        $articles = $this->articleDAO->showArticles($category);

        /* Get user Name with is Id*/
        foreach($articles as $article){
            $userId = $article->getUserId();
            $users = $this->userDAO->getUser($userId);
            $usersName = $users->getLastName();
        }
        
        return $this->view->render('administration',[
            'articles' => $articles,
            'usersName' => $usersName
        ]);
 
    }

    public function previewArticle(Parameter $post)
    {
        $response = array('title'=>'', 'content'=>'', 'filepath'=>'','filename'=>'','error'=>'','articleId'=>'','choice'=>'');
        $errors = $this->validation->validate($post, 'article');
        if($errors) {
            if($errors['title']){
                $response['error'] = $errors['title'];
            } else {
                $response['error'] = $errors['content'];
            }
        }

        if($post->get('title') && $post->get('content')) {
            $response['choice'] = $post->get('category');
            $response['title'] = $post->get('title');
            $response['content'] = $post->get('content');
        }

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
                } 
            } 
            else{
                $response['error'] = "Error: Il y a eu un problème de téléchargement de votre fichier. Veuillez réessayer."; 
            }
        } 
        
        echo json_encode($response);

    }

    public function addArticle(Parameter $post)
    {   
       
        /* If $status = 1 article is published else if =0 is save*/
        if($post->get('submit')) {
            $status = 1;
        }
        if($post->get('save')){
            $status = 0;
        }
        /*category choice*/
        if($post->get('choice')== 'actuality'){
            $category = 1;
        }
        if($post->get('choice')== 'story'){
            $category = 2;
        }

        if($post->get('submit') || $post->get('save')){
            $this->articleDAO->addArticle($post, $this->session->get('id'), $status, $category);
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

    public function updateArticle(Parameter $get, $post)
    {
            if($get->get('articleId')){
                $articleId = $get->get('articleId');
                $article = $this->articleDAO->showArticle($articleId);
            }
            if($post->get('save') || $post->get('submit')) {
                $errors = $this->validation->validate($post, 'updateArticle');
                if(!$errors){
                    if($post->get('save')){
                        $status = 0;
                        $session = 'Article mis à jour et bien enregistrer';
                    }
                    elseif($post->get('submit')){
                        $status = 1;
                        $session = 'Article mis à jour et publié';
                    }
                    $this->articleDAO->updateArticle($post, $articleId, $status);
                    $this->session->set('updatearticle', $session);
                    header('Location: ../public/index.php?route=administration');
                    exit(); 
                }
                return $this->view->render('updatearticle', [
                    'article'=>$article,
                    'errors' => $errors
                ]);
            }
            return $this->view->render('updatearticle', [
                'article'=>$article,
            ]);     
    } 
    
    public function fileUpload($post)
    {
       /*if(!empty($post->get('articleId'))){
            $articleId = $post->get('articleId');
        }*/
        if($_FILES['photo']){
            if($_FILES['photo'] && $_FILES['photo'] ["error"] == 0 ){
                $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
                $filename = $_FILES["photo"]["name"];
                $filetype = $_FILES["photo"]["type"];
                $filesize = $_FILES["photo"]["size"];

                $extension = pathinfo($filename, PATHINFO_EXTENSION);
                if(!array_key_exists($extension, $allowed)) echo "Erreur : Veuillez sélectionner un format de fichier valide.";
                $maxsize = 5 * 1024 * 1024;
                if($filesize > $maxsize) echo "Error: La taille du fichier est supérieure à la limite autorisée.";

                if(in_array($filetype, $allowed)){
                    // Vérifie si le fichier existe avant de le télécharger.
                    if(file_exists("../public/assets/img/upload/" . $_FILES["photo"]["name"])){
                        echo $_FILES["photo"]["name"] . " existe déjà.";
                    } else{
                        move_uploaded_file($_FILES["photo"]["tmp_name"], "../public/assets/img/upload/" . $_FILES["photo"]["name"]);
                        /*save name in database*/
                        $this->userDAO->uploadPicture($this->session->get('mail'), $filename);

                        /*For update article*/
                        if(!empty($post->get('articleId'))){
                            $articleId = $post->get('articleId');
                            $this->articleDAO->uploadPicture($articleId, $filename);
                        }
                        
                        echo "Votre fichier a été téléchargé avec succès."; 
                    } 
                } else{
                    echo "Error: Il y a eu un problème de téléchargement de votre fichier. Veuillez réessayer."; 
                }
            } else{
                echo "Error: Fichier absent ou probleme de fichier";
            }
        }
    }

    public function deleteArticle($get)
    {
        $response = array('isSuccess'=>false, 'message'=>'');
        if($get->get('articleId')){
            $articleId = $get->get('articleId');
            $this->articleDAO->deleteArticle($articleId);
            $response['isSuccess'] = TRUE;
            $response['message'] = 'Article bien supprimer';
        }else {
            $response['isSuccess'] = false;
            $response['message'] = 'Suppression impossible';
        }

        echo json_encode($response);
        
    }

    public function publishOrnotArticle(Parameter $get)
    {
        if($get->get('articleId')){
            $articleId= $get->get('articleId');
            if($get->get('action') === 'Article publié'){
                $status = 0;
                $this->articleDAO->publishOrnotArticle($articleId, $status);
                $this->session->set('status_article', 'Votre article a bien été retiré');
            }
            if($get->get('action') === 'Brouillon'){
                $status = 1;
                $this->articleDAO->publishOrnotArticle($articleId, $status);
                $this->session->set('status_article', 'Votre article a bien été publié');
            }
            
            header('Location: index.php?route=administration');
                    exit();
        
        }
        $this->errorController->errorNotFound();
        
    }
}