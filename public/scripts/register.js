const form = document.querySelector("form");
const nick = document.getElementById("nick");
const email = document.getElementById("email");
const password = document.getElementById("password");

const message = document.querySelector(".login-message");

const regNick = /^[a-zA-z\d]{3,18}$/;
const regEmail = /^[a-z\d]+[\w\d.-]*@(?:[a-z\d]+[a-z\d-]+\.){1,5}[a-z]{2,6}$/i;
const regPassword = /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d][A-Za-z\d!@#$%^&*()_+]{7,19}$/

form.addEventListener("submit", e => {
    e.preventDefault();

    if(regNick.test(nick.value)) {
        if(regEmail.test(email.value)){
            if(regPassword.test(password.value)){
                e.target.submit();
            }
            else {
                message.innerHTML = "Invalid password";
            }
        }
        else {
            console.debug(message)
            message.innerHTML = "Invalid email";
        }
    }
    else {
        console.debug(message)
        message.innerHTML = "Invalid nick";
    }
})