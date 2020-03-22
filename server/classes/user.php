<?php

namespace server\classes;

use Connection\MysqliConnection;
use Connection\Connection;

class User
{
    protected $userLogin;
    protected $userPassword;

    function __construct()
    {
    }

    public function getUser()
    {
        $result = array();
        $conn = new Connection();
        $db = new MysqliConnection();
        try {
            $db->connect($conn);
            $db->startTransaction();
            $userLogin = $db->prepare($this->userLogin);
            $userPassword = $db->prepare($this->userPassword);
            $table = $db->quote('users');
            $query = "SELECT (ID, LOGIN) FROM $table WHERE VALUE (LOGIN = $userLogin, PASSWORD = $userPassword)";
            $dbResult = $db->query($query);
            $db->commitTransaction();
            $db->close();
            if($arDesult = $dbResult->fetch_assoc()){
                $result['DATA'] = $arDesult;
            }
            $result['STATUS'] = 'SUCCESS';
        } catch (\Exception $e) {
            $db->rollbackTransaction();
            $result['STATUS'] = 'EXCEPTION';
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