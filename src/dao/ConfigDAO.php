<?php

namespace Spac\src\DAO;

use Spac\config\Parameter;
use Spac\src\model\Config;

class ConfigDAO extends DAO
{
    private function buildObject($row)
    {
        $config = new Config();
        $config->setContribution($row['contribution']);
        $config->setAddress($row['address']);
        $config->setMail($row['email']);
        $config->setPhone($row['phone']);
        return $config;
    }

    public function getConfig()
    {
        $sql = 'SELECT * FROM config';
        $result = $this->createQuery($sql);
        $config = $result->fetch();
        $config = $this->buildObject($config);
        $result->closeCursor();
        return $config;

    }

    public function updateContribution($contribution)
    {     
        $sql = 'UPDATE config SET contribution = :contribution';
        $this->createQuery($sql, [
            'contribution'=>$contribution]);
  
    }




}