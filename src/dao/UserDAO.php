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
        $isPasswordValid = $post->get('password')=== $result['password'];
        return [
            'result' => $result,
            'isPasswordValid' => $isPasswordValid
        ];
    }
}