let imgDisplay = document.querySelector("#pp-display");

let profilPics = document.querySelectorAll(".js-choice");

let btnConfirm = document.querySelector("#confirm-profil-pic");

if (typeof(profilPics) != 'undefined' && profilPics != null)
{
    profilPics.forEach(pic => {
        pic.addEventListener('click', (e)=>{
            changeProfilPic(pic.src);
            changeConfirmHref(pic.dataset.id);
        })
    })
}

function changeProfilPic(src){
    imgDisplay.src=src;
}

function changeConfirmHref(idProfilPic){

    let oldUrl = btnConfirm.href.split("/");
    
    let url = "/profil-general/"+idProfilPic+"/"+oldUrl[5];

    btnConfirm.href=url;

}