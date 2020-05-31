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
    
    /*Preview article article before validation addArticle*/
    public function previewArticle(Parameter $post)
    {
        $response = array('title'=>'', 'content'=>'', 'filepath'=>'','filename'=>'','error'=>'','articleId'=>'','choice'=>'');
        /*Check title and content error*/
        $errors = $this->validation->validate($post, 'article');
        if($errors) {
            if($errors['title'] || $errors['content']){ 
                $response['error'] = 'Veuillez remplir tous les champs';
            } 
        }
        
        /*If not error save*/
        if($post->get('title') && $post->get('content')) {
            $response['choice'] = $post->get('category');
            $response['title'] = $post->get('title');
            $response['content'] = $post->get('content');
        }

        /*Control Uploaded file*/
        if($_FILES['photo'] && $_FILES['photo']["error"] == 0 ){
            $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
            $filename = $_FILES["photo"]["name"];
            $filetype = $_FILES["photo"]["type"];
            $filesize = $_FILES["photo"]["size"];
            
            $extension = pathinfo($filename, PATHINFO_EXTENSION);
            /*Change automatically filename*/
            $filename= time().'.'.$extension;
            if(!array_key_exists(strtolower($extension), $allowed)) $response['error'] = "Erreur : Veuillez sélectionner un format de fichier valide.";
            $maxsize = 5000000000;
            if($filesize > $maxsize) $response['error'] = "Error: La taille du fichier est supérieure à la limite autorisée.";

            if(in_array($filetype, $allowed)){
                /* Check if file exist*/
                $location = "../public/assets/img/upload/" . $filename;
                if(file_exists($location)){
                    $response['error'] = $filename . " existe déjà.";
                } else{
                    move_uploaded_file($_FILES["photo"]["tmp_name"], $location);
                    $response['filepath'] = $location;
                    $response['filename'] = $filename;
                } 
            } 
            else{
                $response['error'] = "Error: Il y a eu un problème de téléchargement de votre fichier. Veuillez réessayer."; 
            }
        }else {
            if( $_FILES['photo']["error"]==1) {
                $response['error'] = 'Fichier trop volumineux';
            }else{
                $response['error']= 'Veuillez ajouter un fichier valide';
            }
            
        }
        /* Return to ajax*/
        echo json_encode($response); 
    }

    /*Add article after preview validation*/
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

    /*Update article*/
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
   
        if($_FILES['photo']){
            if($_FILES['photo'] && $_FILES['photo'] ["error"] == 0 ){
                $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
                $filename = $_FILES["photo"]["name"];
                $filetype = $_FILES["photo"]["type"];
                $filesize = $_FILES["photo"]["size"];

                $extension = pathinfo($filename, PATHINFO_EXTENSION);
                $filename= time().'.'.$extension;
                if(!array_key_exists(strtolower($extension), $allowed)) echo "Erreur : Veuillez sélectionner un format de fichier valide.";
                $maxsize = 5000000000;
                if($filesize > $maxsize) echo "Error: La taille du fichier est supérieure à la limite autorisée.";

                if(in_array($filetype, $allowed)){
                    // Vérifie si le fichier existe avant de le télécharger.
                    if(file_exists("../public/assets/img/upload/" . $filename)){
                        echo $_FILES["photo"]["name"] . " existe déjà.";
                    } else{
                        move_uploaded_file($_FILES["photo"]["tmp_name"], "../public/assets/img/upload/" . $filename);
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

    public function deleteArticle($post)
    {
        if($post->get('articleId')){
            $articleId = $post->get('articleId');
            $this->articleDAO->deleteArticle($articleId);
            $this->session->set('delete_article','Article bien supprimer');
        }else {
            $this->session->set('delete_article','Suppression impossible');
        }

        header('Location: ../public/index.php?route=administration');
        exit();
        
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