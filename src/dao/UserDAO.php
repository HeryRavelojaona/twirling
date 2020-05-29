<?php

namespace Spac\src\DAO;

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
        $user->setFileName($row['filename']);
        return $user;
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

    public function getUsers()
    {
        //articles for Front view
        $sql = "SELECT user.id , user.lastname, user.firstname,user.status, user.filename FROM user ORDER BY user.id ASC "; 
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
}