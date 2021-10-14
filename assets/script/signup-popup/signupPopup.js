//variable signup
let btnSignup = document.querySelector('.bouton-signup');
let divSignup = document.querySelector('#popup-signup');
let closeSignup = document.querySelector('#close-signup');

//outside the popup
let divCloseSignup = document.querySelector('.close-popup-signup');

//variable dropdown PETIT ECRAN
let dropdownSignup = document.querySelector('#dropdown-signup');

//Make visible on click :

btnSignup.addEventListener('click', (e)=>{
    MakeSignupVisible();
})

dropdownSignup.addEventListener('click', (e)=>{
    MakeSignupVisible();
})

function MakeSignupVisible(){
    divSignup.classList.remove("overlay");
    divSignup.classList.add("not-overlay");
}


//Hide on click :

closeSignup.addEventListener('click', (e)=>{
    MakeSignupHidden();
})

function MakeSignupHidden(){
    divSignup.classList.remove("not-overlay");
    divSignup.classList.add("overlay");
}

//Hide on click outside the popup :

divCloseSignup.addEventListener('click', (e)=>{
    MakeSignupHidden();
})