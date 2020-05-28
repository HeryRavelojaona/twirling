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
        elseif($name === 'article') {
            $articleValidation = new ArticleValidation();
            $errors = $articleValidation->check($data);
            return $errors;
        }
        elseif($name === 'updateArticle') {
            $articleValidation = new ArticleValidation();
            $errors = $articleValidation->check($data);
            return $errors;
        }
    }
}