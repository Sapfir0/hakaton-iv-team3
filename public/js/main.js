document.addEventListener('DOMContentLoaded', start);

const serverUrl = "/server/ajax.php";
import { post } from "./ajaxHelper.js";

function start() {
    const sendButton = document.getElementById("sendBtn");

    sendButton.addEventListener('click', async () => {
        const messageText = document.getElementById("messageInput").value;
        insertMessageToHtml(messageText, true);

        await addMessage(messageText);
    })
}

function insertMessageToHtml(messageText, isMyMessage) {
    const chat = document.getElementById('chat');
    const messageClass = isMyMessage ? "my-message" : "other-message";
    const html = `<div class='${messageClass}'> ${messageText} </div>`;
    chat.insertAdjacentHTML('beforeend', html);
}

async function addMessage(messageText, userId, chatId) {
    return await post(serverUrl , {"text": messageText, "request_action" : "sendMessage"});
}

async function getMessages(userId, chatId) {
    return await post(serverUrl,{"request_action" : "gesMessages"});
}
