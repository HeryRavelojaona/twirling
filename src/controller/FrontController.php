<?php

namespace Spac\src\controller;

use Spac\config\Parameter;


class FrontController extends Controller
{

    public function home()
    {
        /**
        * @param boolean $published if the article is published
        * @param int $start sql DESC LIMIT start
        * @param int $limit sql DESC LIMIT end
        */
 
        $published = true;
        $start = 0;
        $limit = 2;
        $articles = $this->articleDAO->showLastArticles( $start, $limit, $published);
        return $this->view->render('home',[
            'articles' => $articles,
        ]);
        
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
                    $this->session->set('login', 'Bonjour '.$result['result']['lastname'].'');
                    $this->session->set('id', $result['result']['id']);
                    $this->session->set('lastname', $result['result']['lastname']);
                    $this->session->set('firstname', $result['result']['firstname']);
                    $this->session->set('mail', $result['result']['email']);
                    $this->session->set('role', $result['result']['role']);
                    $this->session->set('filename', $result['result']['filename']);
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

    public function logout()
    {
        $this->session->stop();
        $this->session->start();
        $this->session->set('logout', 'Vous êtes déconnecter');
        header('Location: ../public/index.php');
        exit();
    }

    public function profile()
    {
        $picture = $this->userDAO->getFile($this->session->get('mail'));
        return $this->view->render('profile',[
            'picture'=>$picture
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
}