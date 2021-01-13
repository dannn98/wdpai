const form = document.querySelector("form");
const email = document.getElementById("email");
const password = document.getElementById("password");

const message = document.querySelector(".login-message");

form.addEventListener("submit", e => {
    e.preventDefault();

    if(email.value){
        if(password.value){
            e.target.submit();
        }
        else {
            message.innerHTML = "Type password";
        }
    }
    else {
        message.innerHTML = "Type email";
    }
})