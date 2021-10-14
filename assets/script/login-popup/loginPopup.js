//variable login
let btnLogin = document.querySelector('.bouton-login');
let divLogin = document.querySelector('#popup-login');
let closeLogin = document.querySelector('#close-login');

//outside the popup
let divCloseLogin = document.querySelector('.close-popup-login');

//variable dropdown PETIT ECRAN
let dropdownLogin = document.querySelector('#dropdown-login');

//Make visible on click :

btnLogin.addEventListener('click', (e)=>{
    MakeLoginVisible();
})

dropdownLogin.addEventListener('click', (e)=>{
    MakeLoginVisible();
})

function MakeLoginVisible(){
    divLogin.classList.remove('overlay');
    divLogin.classList.add('not-overlay');
}


//Hide on click :

closeLogin.addEventListener('click', (e)=>{
    MakeLoginHidden();
})

function MakeLoginHidden(){
    divLogin.classList.remove('not-overlay');
    divLogin.classList.add('overlay');
}


//Hide on click outside the popup :

divCloseLogin.addEventListener('click', (e)=>{
    MakeLoginHidden();
})