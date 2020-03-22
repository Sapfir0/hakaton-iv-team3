document.addEventListener('DOMContentLoaded', start);

const serverUrl = "/server/ajax.php";
import { post } from "./ajaxHelper.js";

var lastMessageDate;

function start() {
    const sendButton = document.getElementById("sendBtn");

    const timerId = setInterval(() => {
        // get all messages by chat id
    }, 1000)

    sendButton.addEventListener('click', async () => {
        const messageText = document.getElementById("messageInput").value;
        const errorBlock = document.getElementsByClassName('error')[0];
        if (!messageText.match(".+") ) {
            showError(errorBlock, "Почему сообщение пустое")
            return
        }
        else  {
            hideError(errorBlock)
        }

        insertMessageToHtml(messageText, true);


        await addMessageToDB(messageText);
    })
}

function showError(element, errorString) {
    element.innerHTML = errorString;
    element.className = 'error'
}

function hideError(element) {
    element.innerHTML = "";
    element.className = 'clear'
}

function insertMessageToHtml(messageText, isMyMessage, dateTime) {
    const chat = document.getElementById('chat');
    const messageClass = isMyMessage ? "my-message" : "other-message";
    const currentDate = new Date();
    const parsedDate = `${currentDate.getHours()}ч ${currentDate.getMinutes()}м ${currentDate.getSeconds()}с`;
    const html = `<div class='${messageClass}'> ${messageText} ${parsedDate} </div>`;
    chat.insertAdjacentHTML('beforeend', html);
}

async function addMessageToDB(messageText, userId, chatId) {
    return await post(serverUrl , {"text": messageText, "request_action" : "sendMessage"});
}

async function getMessagesFromDB(userId, chatId) {
    return await post(serverUrl,{"request_action" : "getMessages"});
}
