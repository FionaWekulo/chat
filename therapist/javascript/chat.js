const form = document.querySelector(".typing-area"),
incoming_id = form.querySelector(".incoming_id").value,
inputField = form.querySelector(".input-field"),
sendBtn = form.querySelector("button"),
chatBox = document.querySelector(".chat-box");

form.onsubmit = (e)=>{
    e.preventDefault();
}

inputField.focus();
inputField.onkeyup = ()=>{
    if(inputField.value != ""){
        sendBtn.classList.add("active");
    }else{
        sendBtn.classList.remove("active");
    }
}

sendBtn.onclick = ()=>{
    $.ajax({
        url: 'php/insert-chat.php',
        type: 'POST',
        data: new FormData(form),
        processData: false,
        contentType: false,
        success: function(data) {
            inputField.value = "";
            scrollToBottom();
        },
        error: function() {
            console.log('An error occurred while sending the chat.');
        }
    });
}

chatBox.onmouseenter = ()=>{
    chatBox.classList.add("active");
}

chatBox.onmouseleave = ()=>{
    chatBox.classList.remove("active");
}


setInterval(() =>{
    $.ajax({
        url: 'php/get-chat.php',
        type: 'POST',
        data: {incoming_id: incoming_id},
        success: function(data) {

            chatBox.innerHTML = data;
            if(!chatBox.classList.contains("active")){
                scrollToBottom();
            }
        },
        error: function() {
            console.log('An error occurred while fetching the chat.');
        }
    });
}, 500);

function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
  }
  