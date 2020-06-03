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
        elseif($name === 'lastName') {
            $error = $this->checkName($name, $value);
            $this->addError($name, $error);
        }
        elseif($name === 'role') {
            $error = $this->checkRole($name, $value);
            $this->addError($name, $error);
        }
        elseif($name === 'firstName') {
            $error = $this->checkName($name, $value);
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
            return $this->constraint->notBlank('Email', $value);
        }
        if($this->constraint->minLength($name, $value, 2)) {
            return $this->constraint->minLength('Email', $value, 2);
        }
 
    }

    private function checkRole($name, $value)
    {
        if($this->constraint->notBlank($name, $value)) {
            return $this->constraint->notBlank('Role', $value);
        }
        if($this->constraint->minLength($name, $value, 2)) {
            return $this->constraint->minLength('Role', $value, 2);
        }
 
    }

    private function checkName($name, $value)
    {
        if($this->constraint->notBlank($name, $value)) {
            return $this->constraint->notBlank('Nom/Prénom', $value);
        }
        if($this->constraint->minLength($name, $value, 2)) {
            return $this->constraint->minLength('Nom/Prénom', $value, 2);
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