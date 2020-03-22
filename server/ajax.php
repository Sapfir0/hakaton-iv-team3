<?php require_once('/var/www/html/prolog.php');

use server\classes\Request;
use server\chat\ChatController;
use server\classes\User;

$request = new Request();

if ($request->isPost())
{
    if ($request->getPost('request_action') === 'sendMessage')
    {
        $userId = $request->getPost('user_id');
        $chatCode = $request->getPost('chat_code');
        $chat = new ChatController($chatCode, $userId);
        $message = htmlspecialchars($request->getPost('message'));
        $chat->setMessage($message);
        $success = $chat->sendMessage();
        if ($success !== false)
        {
            echo ['success' => 'Сообщение отправлено'];
        }
        else
        {
            echo ['error' => 'Сообщение не отправлено'];
        }
    }

    if ($request->getPost('request_action') === 'getMessages')
    {
        $chatCode = $request->getPost('chat_code');
        $userId = $request->getPost('user_id');
        $chat = new ChatController($chatCode, $userId);
        $messages = $chat->getLastMessages();
        if ($messages !== false)
        {
            $result = json_encode($messages);
            echo $result;
        }
        else
        {
            echo ['error' => 'Невозможно получить информацию о сообщениях в чате'];
        }
    }

    if ($request->getPost('request_action') === 'auth') {
        //
        $form = $request->getPost('USER_AUTHORIZE');
        $login = $form['LOGIN'];
        $password = $form['PASSWORD'];
        echo json_encode(array($login, $password));
        die();
        $userManager = new User();
        $userManager->setUserLogin($login);
        $userManager->setUserPassword($password);
        $result = $userManager->getUser();
    }
}

//echo json_encode($result);
echo json_encode($_POST);
