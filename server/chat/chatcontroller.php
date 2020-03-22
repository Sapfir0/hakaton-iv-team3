<?php


namespace server\chat;

use Cassandra\Date;
use Connection\MysqliConnection;
use Connection\Connection;

class ChatController
{
    protected $chatCode;
    protected $userId;
    protected $message;

    function __construct($chatCode, $userId)
    {
        $this->chatCode = htmlspecialchars($chatCode);
        $this->userId = htmlspecialchars($userId);
    }

    public function sendMessage()
    {
        $conn = new Connection();
        $db = new MysqliConnection();
        try {
            $db->connect($conn);
            $db->startTransaction();
            $chatCode = $db->prepare($this->chatCode);
            $userId = $db->prepare($this->userId);
            $message = $db->prepare($this->message);
            $table = $db->quote('messages');
            $now = new \DateTime();
            $createDate = $now->format('Y-m-d h:i:s');
            $query = "INSERT INTO $table (MESSAGE, CHAT_KEY, USER_ID, DATE_CREATE) VALUE ($message, $chatCode, $userId, $createDate)";
            $db->query($query);
            $db->commitTransaction();
            $db->close();
            return true;
        }
        catch (\Exception $e)
        {
            $db->rollbackTransaction();
            return false;
        }

    }

    public function getMessages()
    {
        
    }

    public function setMessage($message)
    {
        $this->message = htmlspecialchars($message);
    }

    public function getMessage($message)
    {
        return $this->message;
    }

}