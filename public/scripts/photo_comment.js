const form = document.querySelector("form");
const comment = document.getElementById("comment");

const message = document.querySelector(".login-message");

const regComment = /^\S+[\s\S]*$/;

form.addEventListener("submit", e => {
    e.preventDefault();

    if(comment.value != "" && comment.value.search(regComment) != -1){
        e.target.submit();
    }
    else {
        message.innerHTML = "Type comment";
    }
})