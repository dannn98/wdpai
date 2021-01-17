class Photo {
    photo_div = document.createElement("div");
    photo_div_a = document.createElement("a");
    photo_div_a_div = document.createElement("div");
    photo_div_a_div_img = document.createElement("img");
    photo_div_title = document.createElement("div");
    photo_div_div = document.createElement("div");
    photo_div_div_name = document.createElement("p");
    photo_div_div_likes = document.createElement("p");
    photo_div_div_type = document.createElement("p");
    photo_div_div_comments = document.createElement("p");

    constructor() {
        this.photo_div.classList.add("home-content-box-photo");
        this.photo_div_a_div.classList.add("home-content-box-photo-img");
        this.photo_div_title.classList.add("home-content-box-photo-title")
        this.photo_div_div.classList.add("home-content-box-photo-info");
        this.photo_div_div_name.classList.add("home-name");
        this.photo_div_div_likes.classList.add("home-likes");
        this.photo_div_div_type.classList.add("home-type");
        this.photo_div_div_comments.classList.add("home-comments");

        this.photo_div.appendChild(this.photo_div_title);
        this.photo_div.appendChild(this.photo_div_a);
        this.photo_div.appendChild(this.photo_div_div);
        this.photo_div_a.appendChild(this.photo_div_a_div);
        this.photo_div_a_div.appendChild(this.photo_div_a_div_img);
        this.photo_div_div.appendChild(this.photo_div_div_name);
        this.photo_div_div.appendChild(this.photo_div_div_likes);
        this.photo_div_div.appendChild(this.photo_div_div_type);
        this.photo_div_div.appendChild(this.photo_div_div_comments);
    }

    addPhoto(photo) {
        this.photo_div_a.href = "/photo/" + photo.id_photo;
        this.photo_div_a_div_img.src = "public/uploads/" + photo.image;
        this.photo_div_title.innerHTML = photo.title;
        this.photo_div_div_name.innerHTML = photo.nick;
        this.photo_div_div_likes.innerHTML = photo.likes;
        this.photo_div_div_type.innerHTML = "DO ZMIANY";
        this.photo_div_div_comments.innerHTML = photo.comments;

        return this.photo_div;
    }
}

fetch('http://localhost:8080/photos', {
    method: 'GET',
})
    .then(response => response.json())
    .then(data => {
        console.log('Success:', data);
        //Równe rozkładanie obrazków po kolumnach
        const col_1 = document.getElementById("col-1");
        const col_2 = document.getElementById("col-2");
        const col_3 = document.getElementById("col-3");

        for(let i = 0, c = 1; i < data.length; i++, c++) {
            let photo = new Photo();
            if((c) % 3 === 0){
                col_3.appendChild(photo.addPhoto(data[i]));
            }
            else if(c % 2 === 0) {
                col_2.appendChild(photo.addPhoto(data[i]));
            }
            else {
                col_1.appendChild(photo.addPhoto(data[i]));
            }
        }
    })
    .catch((error) => {
        console.error('Error:', error);
    });