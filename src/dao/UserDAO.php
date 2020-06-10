<?php

namespace Spac\src\dao;

use Spac\config\Parameter;
use Spac\src\model\User;

class UserDAO extends DAO
{
    
    private function buildObject($row)
    {
        $user = new User();
        $user->setId($row['id']);
        $user->setLastName($row['lastname']);
        $user->setFirstName($row['firstname']);
        $user->setEmail($row['email']);
        $user->setStatus($row['status']);
        $user->setRole($row['role']);
        $user->setComment($row['comment']);
        $user->setFileName($row['filename']);
        $user->setVisible($row['visible']);
        $user->setLaw($row['law']);
        return $user;
    }

    public function addUser(Parameter $post, $function, $filename=NULL, $role=NULL)
    {  
        $sql = 'INSERT INTO user (lastname, firstname, email, password, filename, role, law, status, visible, comment) VALUES (:lastname, :firstname, :email, :password, :filename, :role, :law, :status, :visible, :comment)';

        $this->createQuery($sql, 
        ['lastname'=>$post->get('lastName'),
         'firstname'=>$post->get('firstName'),
         'email'=>$post->get('mail'),
         'password'=>password_hash($post->get('password'), PASSWORD_BCRYPT),
         'filename' =>$filename,
         'role' =>$role,
         'law' => $post->get('role'),
         'status'=> $function,
         'visible'=>0,
         'comment'=> $post->get('comment')

         ]);
    }

    public function login(Parameter $post)
    {   
        $sql = 'SELECT * FROM user WHERE email = ?';
        $data = $this->createQuery($sql, [$post->get('mail')]);
        $result = $data->fetch();
        $isPasswordValid = password_verify($post->get('password'),$result['password']);
        return [
            'result' => $result,
            'isPasswordValid' => $isPasswordValid
        ];
    }

    public function updatePassword(Parameter $post, $mail)
    {
        $sql = 'UPDATE user SET password = :password WHERE email = :mail';
        $this->createQuery($sql, [
            'password'=>password_hash($post->get('password'), PASSWORD_BCRYPT),
            'mail'=> $mail]);
    }

    public function updateVisibility($userId, $visible)
    {
        
        $sql = 'UPDATE user SET visible = :visible WHERE id = :userId';
        $this->createQuery($sql, [
            'visible'=>$visible,
            'userId'=> $userId]);
    }

    public function uploadPicture($mail, $filename)
    {
        $sql = 'UPDATE user SET filename = :filename WHERE email = :mail';
        $this->createQuery($sql, [
            'filename'=>$filename,
            'mail'=> $mail]);
    }

    public function getFile($mail)
    {
        $sql = 'SELECT filename FROM user WHERE email = :email';
        $result = $this->createQuery($sql, ['email'=>$mail]);
        $filename = $result->fetchColumn();
   
        return $filename;
    }

    public function getUsers($visible=NULL)
    {
        //User for Front view
        if($visible){
            $sql = "SELECT user.id , user.lastname, user.firstname, user.email, user.status, user.filename, user.role, user.law, user.visible, user.comment FROM user WHERE visible=$visible ORDER BY user.id ASC "; 
        }
        else{
            $sql = "SELECT user.id , user.lastname, user.firstname, user.email, user.status, user.filename, user.role, user.law, user.visible, user.comment FROM user ORDER BY user.id ASC "; 
        }
        
        $result = $this->createQuery($sql);
        $users = [];
        foreach ($result as $row){
            $userId = $row['id'];
            $users[$userId] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $users;
    }

    public function getAdmins()
    {
      
        $sql = "SELECT user.id , user.lastname, user.firstname, user.email, user.status, user.filename, user.role, user.law, user.visible, user.comment FROM user WHERE status=1 ORDER BY user.id ASC "; 
   
        $result = $this->createQuery($sql);
        $users = [];
        foreach ($result as $row){
            $userId = $row['id'];
            $users[$userId] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $users;
    }

    public function getMembers()
    {
      
        $sql = "SELECT user.id , user.lastname, user.firstname, user.email, user.status, user.law, user.filename, user.role, user.visible, user.comment FROM user WHERE status=2 ORDER BY user.id ASC "; 
   
        $result = $this->createQuery($sql);
        $users = [];
        foreach ($result as $row){
            $userId = $row['id'];
            $users[$userId] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $users;
    }

    public function getUser($userId)
    {
        $sql = 'SELECT * FROM user WHERE user.id = '.$userId.'';
        $result = $this->createQuery($sql);
        $user= $result->fetch();
        $user = $this->buildObject($user);
        $result->closeCursor();
        return $user;
    }

    public function deleteUser($userId)
    {
        $sql = 'DELETE FROM user WHERE id = ?';
        $this->createQuery($sql, [$userId]); 
    }
}