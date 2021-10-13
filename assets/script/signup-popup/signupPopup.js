//variable signup
let btnSignup = document.querySelector('.bouton-signup');
let divSignup = document.querySelector('#popup-signup');
let closeSignup = document.querySelector('#close-signup');


//Make visible on click :

btnSignup.addEventListener('click', (e)=>{
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