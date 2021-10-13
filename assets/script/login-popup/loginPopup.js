//variable login
let btnLogin = document.querySelector('.bouton-login');
let divLogin = document.querySelector('#popup-login');
let closeLogin = document.querySelector('#close-login');


//Make visible on click :

btnLogin.addEventListener('click', (e)=>{
    MakeLoginVisible();
})

function MakeLoginVisible(){
    divLogin.classList.remove("overlay");
    divLogin.classList.add("not-overlay");
}


//Hide in click :

closeLogin.addEventListener('click', (e)=>{
    MakeLoginHidden();
})

function MakeLoginHidden(){
    divLogin.classList.remove("not-overlay");
    divLogin.classList.add("overlay");
}
