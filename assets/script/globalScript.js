let imgDisplay = document.querySelector("#pp-display");

const profilPics = document.querySelectorAll(".js-choice");

profilPics.forEach(pic => {
    pic.addEventListener('click', (e)=>{
        changeProfilPic(pic.src);
    })
})

function changeProfilPic(src){
    imgDisplay.src=src;
}

import './carousel-active/carouselActive';

