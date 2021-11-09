let imgDisplay = document.querySelector("#pp-display");

let profilPics = document.querySelectorAll(".js-choice");

let confirmProfilPic = document.querySelector("#confirm-profil-pic");

let submitBtn = document.querySelector("#user_pseudo_pw_submit");

let oldPasswordInput = document.querySelector('#user_pseudo_pw_oldPassword');
let newPseudoInput = document.querySelector('#user_pseudo_pw_pseudo');
let newPasswordInput = document.querySelector('#user_pseudo_pw_newPassword');

if (typeof(profilPics) != 'undefined' && profilPics != null)
{
    profilPics.forEach(pic => {
        pic.addEventListener('click', (e)=>{
            changeProfilPic(pic.src);
            changeConfirmProfilPicValue(pic.dataset.id);
        })
    })
}

if (typeof(submitBtn) != 'undefined' && submitBtn != null)
{
    submitBtn.innerHTML='Confirm'
    newPseudoInput.removeAttribute('required');
    newPasswordInput.removeAttribute('required');
    oldPasswordInput.removeAttribute('required');
}

function changeProfilPic(src){
    imgDisplay.src=src;
}

function changeConfirmProfilPicValue(idProfilPic){

    confirmProfilPic.value = idProfilPic;

}