//variable login
let btnLogin = document.querySelector('.bouton-login');
let divLogin = document.querySelector('#popup-login');
let closeLogin = document.querySelector('#close-login');


//variable signup
let btnSignup = document.querySelector('.bouton-signup');
let divSignup = document.querySelector('#popup-signup');
let closeSignup = document.querySelector('#close-signup');


//login

btnLogin.addEventListener('click', (e)=>{
    MakeLoginVisible();
})

function MakeLoginVisible(){
    divLogin.classList.remove("overlay");
    divLogin.classList.add("not-overlay");
}

closeLogin.addEventListener('click', (e)=>{
    MakeLoginHidden();
})

function MakeLoginHidden(){
    divLogin.classList.remove("not-overlay");
    divLogin.classList.add("overlay");
}


//signup

btnSignup.addEventListener('click', (e)=>{
    MakeSignupVisible();
})

function MakeSignupVisible(){
    divSignup.classList.remove("overlay");
    divSignup.classList.add("not-overlay");
}

closeSignup.addEventListener('click', (e)=>{
    MakeSignupHidden();
})

function MakeSignupHidden(){
    divSignup.classList.remove("not-overlay");
    divSignup.classList.add("overlay");
}