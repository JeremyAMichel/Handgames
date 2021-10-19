//variable signup
let btnSignup = document.querySelector('.bouton-signup');
let divSignup = document.querySelector('#popup-signup');
let closeSignup = document.querySelector('#close-signup');

//outside the popup
let divCloseSignup = document.querySelector('.close-popup-signup');

//variable dropdown PETIT ECRAN
let dropdownSignup = document.querySelector('#dropdown-signup');

//Make visible on click :

if (typeof(btnSignup) != 'undefined' && btnSignup != null)
{
    btnSignup.addEventListener('click', (e)=>{
        MakeSignupVisible();
    })
}

if (typeof(dropdownSignup) != 'undefined' && dropdownSignup != null)
{
    dropdownSignup.addEventListener('click', (e)=>{
        MakeSignupVisible();
    })
}

function MakeSignupVisible(){
    divSignup.classList.remove("overlay");
    divSignup.classList.add("not-overlay");
}


//Hide on click :
if (typeof(closeSignup) != 'undefined' && closeSignup != null)
{
    closeSignup.addEventListener('click', (e)=>{
        MakeSignupHidden();
    })
}

function MakeSignupHidden(){
    divSignup.classList.remove('not-overlay');
    divSignup.classList.add('not-overlay-temp');

    let timeOut = setTimeout(function() {
        addOverlayClassToSignupPopup(divSignup);
    },600);
}

function addOverlayClassToSignupPopup(divSignup){
    divSignup.classList.add('overlay');
    divSignup.classList.remove('not-overlay-temp');
}

//Hide on click outside the popup :

if (typeof(divCloseSignup) != 'undefined' && divCloseSignup != null)
{
    divCloseSignup.addEventListener('click', (e)=>{
        MakeSignupHidden();
    })
}