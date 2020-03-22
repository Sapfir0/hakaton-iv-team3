<?php

namespace server\classes;

use Connection\SqlConnectionException;
use Connection\SqlQueryException;
use mysqli;

class DataBaseConnection
{
    protected $host;
    protected $user;
    protected $password;
    protected $db;
    protected $connection = null;

    public function __construct()
    {
        $this->host = 'localhost';
        $this->user = 'team3';
        $this->password = '4m3J>[Ry7N}nQ_Y8';
        $this->db = 'team3_db';
    }

    public function __destruct()
    {
        if ($this->connection != null) {
            $this->closeConnection();
        }
    }

    protected function makeConnection()
    {
        try {
            $this->connection = new mysqli($this->host, $this->user, $this->password, $this->db);
        }
        catch (\Exception $e)
        {
            return $e->getMessage();
        }
        return "sosi pisos";
        if ($this->connection->connect_error) {
            echo 'Fail' . $this->connection->connect_error;
        }
    }

    protected function closeConnection()
    {
        if ($this->connection != null) {
            $this->connection = null;
        }
    }

    public function executeQuery($query, $params = null)
    {
        return $this->makeConnection();
        if ($params != null) {
            $queryParts = preg_split('/\?/', $query);
            if (count($queryParts) != count($params) + 1) {
                return false;
            }
            $finalQuery = $queryParts[0];
            for ($i = 0; $i < count($params); $i++) {
                $finalQuery = $finalQuery . $this->cleanParameters($params[$i]) . $queryParts[$i + 1];
            }
            $query = $finalQuery;
        }

        $result = $this->connection->query($query);

        return $result->fetch_assoc();
    }

    protected function cleanParameters($parameters)
    {
        $result = $this->connection->real_escape_string($parameters);
        return $result;
    }
}