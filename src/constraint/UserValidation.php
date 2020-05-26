<?php

namespace Spac\src\constraint;
use Spac\config\Parameter;

class UserValidation extends Validation
{
    private $errors = [];
    private $constraint;

    public function __construct()
    {
        $this->constraint = new Constraint();
    }

    public function check(Parameter $post)
    {
        foreach ($post->all() as $key => $value) {
            $this->checkField($key, $value);
        }
        return $this->errors;
    }

    private function checkField($name, $value)
    {
        if ($name === 'mail') {
            $error = $this->checkMail($name, $value);
            $this->addError($name, $error);
        }
        elseif($name === 'password') {
            $error = $this->checkPass($name, $value);
            $this->addError($name, $error);
        }
        elseif($name === 'samePassword') {
            $error = $this->checkPass($name, $value );
            $this->addError($name, $error);
        }
  
    }

    private function addError($name, $error) {
        if($error) {
            $this->errors += [
                $name => $error
            ];
        }
    }

    private function checkMail($name, $value)
    {
        if($this->constraint->notBlank($name, $value)) {
            return $this->constraint->notBlank('mail', $value);
        }
        if($this->constraint->minLength($name, $value, 2)) {
            return $this->constraint->minLength('mail', $value, 2);
        }
 
    }

    private function checkPass($name, $value)
    {
        if($this->constraint->notBlank($name, $value)) {
            return $this->constraint->notBlank('mot de passe', $value);
        }
        if($this->constraint->minLength($name, $value, 2)) {
            return $this->constraint->minLength('mot de passe', $value, 2);
        }
        if($this->constraint->maxLength($name, $value, 255)) {
            return $this->constraint->maxLength('mot de passe', $value, 255);
        } 
    }

}