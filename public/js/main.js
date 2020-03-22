document.addEventListener('DOMContentLoaded', start);

const serverUrl = "/server/ajax.php";
import { post } from "./ajaxHelper.js";
import {showError, hideError} from "./frontErrors.js"

var lastMessageDate;

function start() {
    const sendButton = document.getElementById("sendBtn");

    const timerId = setInterval(() => {
        // get all messages by chat id
        // if db last message has older timestamp - refresh it
    }, 1000)

    sendButton.addEventListener('click', async () => {
        const messageText = document.getElementById("messageInput").value;
        const errorBlock = document.getElementById('error');
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

function insertMessageToHtml(messageText, isMyMessage, dateTime) {
    const chat = document.getElementById('chat');
    const messageClass = isMyMessage ? "my-message" : "other-message";
    const currentDate = new Date();
    const parsedDate = `${currentDate.getHours()}ч ${currentDate.getMinutes()}м ${currentDate.getSeconds()}с`;
    const html = `<div class='${messageClass}'> ${messageText} <div class="date"> ${parsedDate} </div> </div>`;
    chat.insertAdjacentHTML('beforeend', html);
}

async function addMessageToDB(messageText, userId, chatId) {
    console.log("to db")
    return await post(serverUrl , {"message": messageText, "request_action" : "sendMessage", "chat_code": chatId, "user_id": userId});
}

async function getMessagesFromDB(userId, chatId) {
    return await post(serverUrl,{"request_action" : "getMessages", "chat_code": chatId, "user_id": userId});
}
