const form = document.querySelector("form");
const comment = document.querySelector("#comment");
const message = document.querySelector(".login-message");
const like = document.querySelector("#like");

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

like.addEventListener("click", e => {
    e.preventDefault();

    const data = { id_photo: document.getElementById("id_photo").value };

    fetch('/like', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(function(response) {
        return response.json();
    })
    .then(function(result) {
        like.innerHTML = String(parseInt(like.innerHTML) + result);
    })
    .catch((error) => {
        console.error('Error:', error);
    });
});