<?php

namespace Spac\src\controller;

use Spac\config\Parameter;

class BackController extends Controller
{
    

    public function admin()
    {
        if($this->checkIfLoggedIn())
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
        
            return $this->view->render('administration',[
                'articles' => $articles,
                'usersName' => $usersName,
                'users' => $users
            ]);
        }
    }

    /*Page config on admin*/
    public function adminConfig()
    {
        if($this->checkIfAdmin())
        {
            $config = $this->configDAO->getConfig();
            return $this->view->render('adminconfig',[
                'config' => $config
            ]);
        }
    }


    /*Page Members on admin*/
    public function adminMembers()
    {
        if($this->checkIfLoggedIn())
        {
            /*All admin members*/
            $allUsers = $this->userDAO->getAdmins();
            /*members ADHERENTS*/
            $members = $this->userDAO->getMembers();
                return $this->view->render('adminmembers',[
                'allUsers' => $allUsers,
                'members' => $members
                ]);
        }
    }

    public function profile($get)
    {
        if($this->checkIfLoggedIn())
        {
            if($get->get('userId'))
            {   $userId = htmlspecialchars($get->get('userId'));
                $user = $this->userDAO->getUser($userId);
                $picture = $this->userDAO->getFile($user->getEmail());
                return $this->view->render('profile',[
                    'user'=>$user,
                    'picture'=>$picture
                ]);
                
            }else
            {
                $picture = $this->userDAO->getFile($this->session->get('mail'));
                return $this->view->render('profile',[
                    'picture'=>$picture
                ]);
            }
                
        }
    }

    /*Page training on admin*/
    public function adminTraining()
    {
        if($this->checkIfLoggedIn())
        {
            /*$category = 3 For training event*/
            $events = $this->eventDAO->showEvents(3);
            return $this->view->render('adminTraining',[
                'events' => $events
            ]);
        }
    }

    /*Page Storyon admin*/
    public function adminStory()
    {
        if($this->checkIfAdmin())
        {
            $category = 2;
            $articles = $this->articleDAO->showArticles($category);
            /* Get user Name with is Id*/
            foreach($articles as $article){
                $userId = $article->getUserId();
                $users = $this->userDAO->getUser($userId);
                $usersName = $users->getFirstName();
            }

            /*Story article*/
            $category = 2;
            $stories = $this->articleDAO->showArticles($category);
            return $this->view->render('adminstory',[
                'stories' => $stories,
                'usersName' => $usersName
            ]);
        }
    }
    
    /*Preview article article before validation addArticle*/
    public function previewArticle(Parameter $post)
    {
        if($this->checkIfLoggedIn())
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
                $tmpname= $_FILES['photo']['tmp_name'];
                $filemime = mime_content_type($tmpname);
                
                $extension = pathinfo($filename, PATHINFO_EXTENSION);
                /*Change automatically filename*/
                $filename= time().'.'.$extension;
                if(!array_key_exists(strtolower($extension), $allowed)) $response['error'] = "Erreur : Veuillez sélectionner un format de fichier valide.";
                $maxsize = 5000000000;
                if($filesize > $maxsize) $response['error'] = "Error: La taille du fichier est supérieure à la limite autorisée.";

                if(in_array($filemime, $allowed)){
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
                    $response['error'] = "Error: Il y a eu un problème de téléchargement de votre fichier, ou votre fichier est invalide."; 
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
    }

    /*Add article after preview validation*/
    public function addArticle(Parameter $post)
    {   
        if($this->checkIfLoggedIn())
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
    }


    /*-------
    Update and change password With an Ajax Call
    ---------*/
    public function updatePassword(Parameter $post)
    {
        if($this->checkIfLoggedIn())
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

    /*Update article*/
    public function updateArticle(Parameter $post, $get)
    { 
        if($this->checkIfLoggedIn())
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
    } 
    
    /* For change picture on profil*/
    public function fileUpload($post)
    {   
        if($this->checkIfLoggedIn())
        {
            if(isset($_FILES['photo'])){
            
                if($_FILES['photo'] && $_FILES['photo'] ["error"] == 0 ){
                    $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
                    $filename = htmlspecialchars($_FILES["photo"]["name"]);
                    $filetype = $_FILES["photo"]["type"];
                    $filesize = $_FILES["photo"]["size"];
                    $tmpname= $_FILES['photo']['tmp_name'];
                    $filemime = mime_content_type($tmpname);
                
                    $extension = pathinfo($filename, PATHINFO_EXTENSION);
        
                    /*Automatically Change filename*/
                    $filename= time().'.'.$extension;
                    /*Check file extension*/
                    if(!array_key_exists(strtolower($extension), $allowed)) echo "Erreur : Veuillez sélectionner un format de fichier valide.";
                    /*Check file size*/
                    $maxsize = 5000000000;
                    if($filesize > $maxsize) echo "Error: La taille du fichier est supérieure à la limite autorisée.";
                    /*check Filemime type*/
                    if(in_array($filemime, $allowed)){
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
                        echo "Error: Il y a eu un problème de téléchargement de votre fichier. Ou votre fichier est invalide."; 
                    }
                } else{
                    echo "Error: Fichier absent ou probleme de fichier";
                }
            }
        }
    }

    public function deleteArticle($post)
    {
        if($this->checkIfLoggedIn())
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
        
    }

    public function publishOrNot(Parameter $get)
    {
        if($this->checkIfLoggedIn())
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
                header('Location: index.php?route=admintraining');
                        exit();
            }

            if($get->get('userId')){
                $userId= $get->get('userId');
                if($get->get('action') == 'Visible'){
                    $visible = 0;
                    $this->userDAO->updateVisibility($userId, $visible);
                    
                    $this->session->set('status_user', 'Le membre a bien été retiré');
                }
                if($get->get('action') == 'Non visible'){
                    $visible = 1;
                    $this->userDAO->updateVisibility($userId, $visible);
                    $this->session->set('status_user', 'Le membre a bien été publié');
                }
            
                header('Location: index.php?route=adminmember');
                        exit();
            }

            $this->errorController->errorNotFound();
        }
        
    }

    public function addEvent($post)
    {
        if($this->checkIfLoggedIn())
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
                header('Location: ../public/index.php?route=admintraining');
                exit();
            }
            
            return $this->view->render('addevent');
        }
    }

    /*Preview article article before validation addArticle*/
    public function previewEvent(Parameter $post)
    {
        if($this->checkIfLoggedIn())
        {
            $response = array('title'=>'', 'content'=>'', 'place'=>'','address'=>'','errortitle'=>'','errorplace'=>'','erroraddress'=>'','errorstart'=>''
            ,'errorend'=>'','errorcontent'=>'','error'=>'','start'=>'','end'=>'');
            /*Check title and content error*/
            $response['error'] = true;
            if(empty($post->get('title')))
            {
                $response['error'] = false;
                $response['errortitle'] = 'Veuillez remplir le champ titre';
            }

            elseif(empty($post->get('place')))
            {
                $response['error'] = false;
                $response['errorplace'] = 'Veuillez remplir le champ lieu';
            }

            elseif(empty($post->get('address')))
            {
                $response['error'] = false;
                $response['erroraddress'] = 'Veuillez remplir le champ Adresse';
            }

            elseif(empty($post->get('start')))
            {
                $response['error'] = false;
                $response['errorstart'] = 'Veuillez renseigner une heure de début';
            }

            elseif(empty($post->get('end')))
            {
                $response['error'] = false;
                $response['errorend'] = 'Veuillez renseigner une heure de fin';
            }

            elseif(strlen($post->get('content'))> 400)
            {
                $response['error'] = false;
                $response['errorcontent'] = 'Message trop long';
            }

            elseif($post->get('end')< $post->get('start') )
            {
                $response['error'] = false;
                $response['errorend'] = 'Veuillez saisir une heure de fin supérieur à la date de début';
            }
            /*If not error save*/
            if($response['error'] == true){
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
    }

    public function deleteEvent($post)
    {
        if($this->checkIfLoggedIn())
        {
            if($post->get('eventId')){
                $eventId = $post->get('eventId');
                $this->eventDAO->deleteEvent($eventId);
                $this->session->set('delete_event','Article bien supprimer');
            }else {
                $this->session->set('delete_event','Suppression impossible');
            }

            header('Location: ../public/index.php?route=admintraining');
            exit();
        }
    }

     /*Update event*/
     public function updateEvent(Parameter $post, $get)
     { 
        if($this->checkIfLoggedIn())
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
                    header('Location: ../public/index.php?route=admintraining');
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
     } 

    /*Add article after preview validation*/
    public function addUser(Parameter $post)
    {   
        if($this->checkIfAdmin())
        {
            if(isset($_FILES['photo'])){
                if($_FILES['photo'] && $_FILES['photo'] ["error"] == 0 ){
                    $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
                    $filename = $_FILES["photo"]["name"];
                    $filetype = $_FILES["photo"]["type"];
                    $filesize = $_FILES["photo"]["size"];
                    $tmpname= $_FILES['photo']['tmp_name'];
                    $filemime = mime_content_type($tmpname);

                    $extension = pathinfo($filename, PATHINFO_EXTENSION);
                    /*Automatically Change filename*/
                    $filename= time().'.'.$extension;
                    if(!array_key_exists(strtolower($extension), $allowed)) echo "Erreur : Veuillez sélectionner un format de fichier valide.";
                    $maxsize = 5000000000;
                    if($filesize > $maxsize) echo "Error: La taille du fichier est supérieure à la limite autorisée.";

                    if(in_array($filemime, $allowed)){
                        /*Check if file exist.*/
                        if(file_exists("../public/assets/img/upload/" . $filename)){
                            echo $_FILES["photo"]["name"] . " existe déjà.";
                        } else{
                            move_uploaded_file($_FILES["photo"]["tmp_name"], "../public/assets/img/upload/" . $filename);
                            echo "Votre fichier a été téléchargé avec succès."; 
                        } 
                    } else{
                        echo "Error: Il y a eu un problème de téléchargement de votre fichier. Ou votre fichier est invalide."; 
                    }
                } 
            }

            $errors = $this->validation->validate($post, 'adduser');
            if($post->get('password') != $post->get('samepassword') ){
                $errors['password'] = '<p>mot de passe non identique</p>';
            }
            if(!$errors){
                /*Status choice*/
                if($post->get('choice')== 'admin'){
                    $function = 1;
                }
                if($post->get('choice')== 'member'){
                    $function = 2;
                }

                /*UserRole and userLaw*/
                if($post->get('role') == 20){ $role = 'Bénévole';}
                if($post->get('role') == 40){ $role = 'Entraineur';}
                if($post->get('role') == 60){ $role = 'Trésorièr/e';}
                if($post->get('role') == 80){ $role = 'Secrétaire';}
                if($post->get('role') == 100){ $role = 'Président';}
                else{$role = 'Adhérent';}
                if($post->get('submit') || $post->get('save')){
                    $this->userDAO->addUser($post, $function, $filename, $role);
                    $this->session->set('adduser','Utilisateur bien ajouté');
                    header('Location: ../public/index.php?route=adminmembers');
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

    public function deleteUser($get)
    {
        if($this->checkIfAdmin())
        {
            if($get->get('userId')){
                $userId = $get->get('userId');
                $this->userDAO->deleteUser($userId);
                $this->session->set('delete_user','Utilisateur bien supprimer');
            }else {
                $this->session->set('delete_user','Suppression impossible');
            }

            header('Location: ../public/index.php?route=adminmembers');
            exit();
        } 
    }

    public function changeConfig($post)
    {
        if($this->checkIfAdmin())
        {
            if($post->get('price')){
                $contribution = htmlspecialchars($post->get('price'));
                $this->configDAO->updateContribution($contribution);
                echo 'Changement effectuer';
            }

            if($post->get('address')){
                $address = htmlspecialchars($post->get('address'));
                $this->configDAO->updateAddress($address);
                echo 'Changement effectuer';
            }

            if($post->get('email')){
                $mail = htmlspecialchars($post->get('email'));
                $this->configDAO->updateMail($mail);
                echo 'Changement effectuer';
            }

            if($post->get('phone')){
                $phone = htmlspecialchars($post->get('phone'));
                $this->configDAO->updatePhone($phone);
                echo 'Changement effectuer';
            }
        }
    }

    public function contactMembers($post)
    {   
        if($this->checkIfLoggedIn())
        {
            if($post->get('submit')){
                $errors = $this->validation->validate($post, 'contact');
                if(!$errors){
                    $users = $this->userDAO->getUsers();
                    foreach($users as $user)
                    {
                        $userMail = $user->getEmail();
                        $this->mailing->contactAll($post,$this->session->get('firstname'), $this->session->get('mail'), $userMail);
                    }
                    
                    $this->session->set('send_message', 'Message bien envoyé');
                    header('Location: index.php?route=adminmembers');
                    exit();
                }
                return $this->view->render('contact_member',[
                        'errors'=> $errors
                    ]);
            }

            return $this->view->render('contact_member');
        }
    }

    /*Contact user*/
    public function contactUser($post, $get)
    {
        if($this->checkIfLoggedIn())
        {
            if($get->get('userId')){
                $userId = $get->get('userId') ;
                $user = $this->userDAO->getUser($userId);
                $userEmail = $user->getEmail();
            }
            
            if($post->get('submit')){
                $errors = $this->validation->validate($post, 'contact');
                if(!$errors){
        
                    $this->mailing->contactUser($post,$this->session->get('firstname'),$userEmail);
                    $this->session->set('user_message', 'Message bien envoyé à '.$user->getFirstName().'');
                    header('Location: index.php?route=adminmembers');
                    exit();
                }
                return $this->view->render('contact_user',[
                        'errors'=> $errors,
                        'user'=> $user
                    ]);

            }

            return $this->view->render('contact_user',[
                'user'=> $user
            ]);
        }
    }

    private function checkIfLoggedIn()
    {
        if(!$this->session->get('id')) {
            $this->session->set('not_login', 'Vous devez vous connecter pour accéder à cette page');
            header('Location: ../public/index.php?route=login');
        } else {
            return true;
        }
    }

    private function checkIfAdmin()
    {
        $this->checkIfLoggedIn();
        if(!($this->session->get('law') >= 80)) {
            $this->session->set('not_admin', 'Vous n\'avez pas les droits pour accéder à cette page');
            header('Location: ../public/index.php?route=administration');
        } else {
            return true;
        }
    }
}