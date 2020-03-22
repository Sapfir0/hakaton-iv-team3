import {post} from "./ajaxHelper.js";

document.addEventListener('DOMContentLoaded', start);

function start() {
    const chatList = getChatsFromDB();
    insertChats(chatList);
}

function insertChats(chatNames) {
    const chatWindow = document.getElementById('chatList');
    let html;
    for(let i=0; i<chatNames.length; i++) {
        html += `<div class="chat">  ${chatNames[i]} </div>`;
    }
    chatWindow.insertAdjacentHTML('beforeend', html);
}

async function getChatsFromDB(userId) {
    // только те, на что у него есть доступ
    return await post(serverUrl,{"request_action" : "getChats", "user_id": userId});
}