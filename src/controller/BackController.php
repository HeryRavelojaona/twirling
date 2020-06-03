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
            $usersName = $users->getFirstName();
        }
        $allUsers = $this->userDAO->getUsers();
        $category = 2;
        $stories = $this->articleDAO->showArticles($category);

        /*$category = 3 For training event*/
        $events = $this->eventDAO->showEvents(3);
        
        return $this->view->render('administration',[
            'articles' => $articles,
            'usersName' => $usersName,
            'events' => $events,
            'stories' => $stories,
            'users' => $users,
            'allUsers' => $allUsers
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
    public function updateArticle(Parameter $post, $get)
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
    
    /* For change picture on profil*/
    public function fileUpload($post)
    {
   
        if($_FILES['photo']){
            if($_FILES['photo'] && $_FILES['photo'] ["error"] == 0 ){
                $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
                $filename = $_FILES["photo"]["name"];
                $filetype = $_FILES["photo"]["type"];
                $filesize = $_FILES["photo"]["size"];

                $extension = pathinfo($filename, PATHINFO_EXTENSION);
                /*Automatically Change filename*/
                $filename= time().'.'.$extension;
                if(!array_key_exists(strtolower($extension), $allowed)) echo "Erreur : Veuillez sélectionner un format de fichier valide.";
                $maxsize = 5000000000;
                if($filesize > $maxsize) echo "Error: La taille du fichier est supérieure à la limite autorisée.";

                if(in_array($filetype, $allowed)){
                    /*Check if file exist.*/
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
            $this->session->set('delete_article','Evènement bien supprimer');
        }else {
            $this->session->set('delete_article','Suppression impossible');
        }

        header('Location: ../public/index.php?route=administration');
        exit();
        
    }

    public function publishOrNot(Parameter $get)
    {
        /*For article*/
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

            /*for Event*/
        if($get->get('eventId')){
          
            $eventId= $get->get('eventId');
            if($get->get('action') === 'Article publié'){
                $status = 0;
                $this->eventDAO->publishOrnotEvent($eventId, $status);
                $this->session->set('status_event', 'Votre article a bien été retiré');
            }
            if($get->get('action') === 'Brouillon'){
                $status = 1;
                $this->eventDAO->publishOrnotEvent($eventId, $status);
                $this->session->set('status_event', 'Votre article a bien été publié');
            }
            header('Location: index.php?route=administration');
                    exit();
        }

        if($get->get('userId')){
            $userId= $get->get('userId');
            if($get->get('action') == 'Visible'){
                $status = 0;
                $this->userDAO->updateStatus($userId, $status);
                
                $this->session->set('status_event', 'Votre article a bien été retiré');
            }
            if($get->get('action') == 'Non visible'){
                $status = 1;
                $this->userDAO->updateStatus($userId, $status);
                $this->session->set('status_event', 'Votre article a bien été publié');
            }
           
            header('Location: index.php?route=administration');
                    exit();
        }

        $this->errorController->errorNotFound();
        
    }

    public function addEvent($post)
    {
          /* If $status = 1 article is published else if =0 is save*/
        if($post->get('submit')) {
        $status = 1;
        }
        if($post->get('save')){
            $status = 0;
        }

        if($post->get('submit') || $post->get('save')){
            /*$category = Training*/
            $category = 3;
            $this->eventDAO->addEvent($post, $this->session->get('id'), $status, $category);
            $this->session->set('addevent','Article bien ajouté');
            header('Location: ../public/index.php?route=administration');
            exit();
        }
        
        return $this->view->render('addevent');
    }

    /*Preview article article before validation addArticle*/
    public function previewEvent(Parameter $post)
    {
        $response = array('title'=>'', 'content'=>'', 'place'=>'','address'=>'','error'=>'','start'=>'','end'=>'');
        /*Check title and content error*/
       if(empty($post->get('title')))
       {
        $response['error'] = 'Veuillez remplir le champ titre';
       }

       if(empty($post->get('place')))
       {
        $response['error'] = 'Veuillez remplir le champ lieu';
       }

       if(empty($post->get('address')))
       {
        $response['error'] = 'Veuillez remplir le champ Adresse';
       }

       if(empty($post->get('start')))
       {
        $response['error'] = 'Veuillez renseigner une heure de début';
       }

       if(empty($post->get('end')))
       {
        $response['error'] = 'Veuillez renseigner une heure de fin';
       }

       if(strlen($post->get('content'))> 400)
       {
        $response['error'] = 'Message trop long';
       }
        
        /*If not error save*/
        if(empty($response['error'])){
            $response['title'] = $post->get('title');
            $response['place'] = $post->get('place');
            $response['address'] = $post->get('address');
            $response['start'] = $post->get('start');
            $response['end'] = $post->get('end');
            $response['content'] = $post->get('content');
        }

        /* Return to ajax*/
        echo json_encode($response); 
    }

    public function deleteEvent($post)
    {
        if($post->get('eventId')){
            $eventId = $post->get('eventId');
            $this->eventDAO->deleteEvent($eventId);
            $this->session->set('delete_event','Article bien supprimer');
        }else {
            $this->session->set('delete_event','Suppression impossible');
        }

        header('Location: ../public/index.php?route=administration');
        exit();
        
    }

     /*Update event*/
     public function updateEvent(Parameter $post, $get)
     { 
             if($get->get('eventId')){
                 $eventId = $get->get('eventId');
                 $event = $this->eventDAO->showEvent($eventId);
             }
             if($post->get('save') || $post->get('submit')) {
                     if($post->get('save')){
                         $status = 0;
                         $session = 'Evènement mis à jour et bien enregistrer';
                     }
                     elseif($post->get('submit')){
                         $status = 1;
                         $session = 'Evènement mis à jour et publié';
                     }
                    
                     $this->eventDAO->updateEvent($post, $eventId, $status);
                     $this->session->set('updateevent', $session);
                     header('Location: ../public/index.php?route=administration');
                     exit(); 
            }else{
                 
                 return $this->view->render('updateevent', [
                     'event'=>$event,
                 ]);
             }
 
             return $this->view->render('updateevent', [
                 'event'=>$event,
             ]);     
     } 

      /*Add article after preview validation*/
    public function addUser(Parameter $post)
    {   
        if(isset($_FILES['photo'])){
            if($_FILES['photo'] && $_FILES['photo'] ["error"] == 0 ){
                $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
                $filename = $_FILES["photo"]["name"];
                $filetype = $_FILES["photo"]["type"];
                $filesize = $_FILES["photo"]["size"];

                $extension = pathinfo($filename, PATHINFO_EXTENSION);
                /*Automatically Change filename*/
                $filename= time().'.'.$extension;
                if(!array_key_exists(strtolower($extension), $allowed)) echo "Erreur : Veuillez sélectionner un format de fichier valide.";
                $maxsize = 5000000000;
                if($filesize > $maxsize) echo "Error: La taille du fichier est supérieure à la limite autorisée.";

                if(in_array($filetype, $allowed)){
                    /*Check if file exist.*/
                    if(file_exists("../public/assets/img/upload/" . $filename)){
                        echo $_FILES["photo"]["name"] . " existe déjà.";
                    } else{
                        move_uploaded_file($_FILES["photo"]["tmp_name"], "../public/assets/img/upload/" . $filename);
                        echo "Votre fichier a été téléchargé avec succès."; 
                    } 
                } else{
                    echo "Error: Il y a eu un problème de téléchargement de votre fichier. Veuillez réessayer."; 
                }
            } 
        }

        $errors = $this->validation->validate($post, 'adduser');
        if($post->get('password') != $post->get('samepassword') ){
            $errors['password'] = '<p>mot de passe non identique</p>';
        }
        /* If $status = 1 article is published else if =0 is save*/
        if(!$errors){
            if($post->get('submit')) {
                $status = 1;
            }
            if($post->get('save')){
                $status = 0;
            }
            /*Status choice*/
            if($post->get('choice')== 'admin'){
                $function = 1;
            }
            if($post->get('choice')== 'member'){
                $function = 2;
            }
    
            if($post->get('submit') || $post->get('save')){
                $this->userDAO->addUser($post, $function, $filename);
                $this->session->set('adduser','Utilisateur bien ajouté');
                header('Location: ../public/index.php?route=administration');
                exit();
            }

        }else {
            return $this->view->render('adduser',[
                'post' => $post,
                'errors' => $errors
            ]);
        }

        return $this->view->render('adduser');
            
            
            
 
    }
}