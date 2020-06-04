<?php

namespace Spac\src\model;

class Config
{
    /**
     * @var decimal
     */
    private $contribution;

    /**
     * @var string
     */
    private $address;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var Decimal
     */
    public function getContribution()
    {
        return $this->contribution;
    }

    /**
     * @param int $contribution
     */
    public function setContribution($contribution)
    {
        $this->contribution = $contribution;
    }

     /**
     * @var string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @var string $Address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

      /**
     * @var string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @var string $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @param int
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param int $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }


}