let imgDisplay = document.querySelector("#pp-display");

const profilPics = document.querySelectorAll(".js-choice");

if (typeof(profilPics) != 'undefined' && profilPics != null)
{
    profilPics.forEach(pic => {
        pic.addEventListener('click', (e)=>{
            changeProfilPic(pic.src);
        })
    })
}

function changeProfilPic(src){
    imgDisplay.src=src;
}