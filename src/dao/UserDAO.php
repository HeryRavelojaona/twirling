<?php

namespace Spac\src\DAO;

use Spac\config\Parameter;
use Spac\src\model\User;

class UserDAO extends DAO
{
    
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
}