fetch('/photos')
.then(response => response.json())
.then(data => {
    const col_1 = document.querySelector("#col-1");
    const col_2 = document.querySelector("#col-2");
    const col_3 = document.querySelector("#col-3");
    for(let i = 0, c = 1; i < data.length; i++, c++) {
        if(c === 3){
            col_3.appendChild(addPhoto(data[i]));
            c = 0;
        }
        else if(c === 2) {
            col_2.appendChild(addPhoto(data[i]));
        }
        else {
            col_1.appendChild(addPhoto(data[i]));
        }
    }

    document.querySelector("#loader").style.display = "none";
    let cols = document.querySelectorAll(".home-content-box-col");
    for(let i = 0; i < cols.length; i++) {
        cols[i].style.display = "block";
    }
})
.catch((error) => {
    console.error('Error:', error);
});

function addPhoto(photo) {
    const template = document.querySelector("#photo-template");
    const clone = template.content.cloneNode(true);

    const link = clone.querySelector("a");
    link.href = "/photo/" + photo.id_photo;
    const image = clone.querySelector("img");
    image.src = "public/uploads/" + photo.image;
    const title = clone.querySelector(".home-content-box-photo-title");
    title.innerHTML = photo.title;

    const name = clone.querySelector(".home-name");
    name.innerHTML = photo.nick;
    const likes = clone.querySelector(".home-likes");
    likes.innerHTML = photo.likes;
    const type = clone.querySelector(".home-type");
    type.innerHTML = "Model(ka)";
    const comments = clone.querySelector(".home-comments");
    comments.innerHTML = photo.comments;

    return clone;
}