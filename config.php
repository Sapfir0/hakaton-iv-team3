<?php
namespace Connection;
use Utility\Loader;

require_once 'iv.utilities\\bootstrap.php';

class Connection implements \Connection\IConnectionConfiguration
{
    private $host = 'team3.ivb24.ru';
    private $login = "team3";
    private $password = "4m3J>[Ry7N}nQ_Y8";
    private $dbname = "team3_db";

    /**
     * @inheritDoc
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @inheritDoc
     */
    public function getUsername()
    {
        return $this->login;
    }

    /**
     * @inheritDoc
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @inheritDoc
     */
    public function getDatabaseName()
    {
        return $this->dbname;
    }
}


