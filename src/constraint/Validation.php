<?php

namespace Spac\src\constraint;

class Validation
{
    public function validate($data, $name)
    {
        if($name === 'login') {
            $userValidation = new UserValidation();
            $errors = $userValidation->check($data);
            return $errors;
        }
        elseif($name === 'updatePassword') {
            $userValidation = new UserValidation();
            $errors = $userValidation->check($data);
            return $errors;
        }
    }
}