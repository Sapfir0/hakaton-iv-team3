<?php

namespace server\classes;

use Connection\MysqliConnection;
use \server\classes\Connection;

class User
{
    protected $userLogin;
    protected $userPassword;

    public function __construct($userLogin, $userPassword)
    {
        $this->userLogin = $userLogin;
        $this->userPassword = $userPassword;
    }

    public function getUser()
    {
        $result = array();
        $db = new DataBaseConnection();
        try {
            $dbResult = $db->executeQuery(
                "SELECT ID, LOGIN, PASSWORD FROM users WHERE LOGIN = '?' AND PASSWORD = '?'",
                array($this->userLogin, $this->userPassword)
            );
            $result['DATA'] = $dbResult;
            $result['STATUS'] = 'SUCCESS';
        } catch (\Exception $e) {
            $result['STATUS'] = 'EXCEPTION';
            return 'test';
        }
        return $result;
    }

    /**
     * @return mixed
     */
    public function getUserLogin()
    {
        return $this->userLogin;
    }

    /**
     * @param mixed $userLogin
     */
    public function setUserLogin($userLogin): void
    {
        $this->userLogin = $userLogin;
    }

    /**
     * @param mixed $userPassword
     */
    public function setUserPassword($userPassword): void
    {
        $this->userPassword = $userPassword;
    }
}