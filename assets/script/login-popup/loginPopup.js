//variable login
let btnLogin = document.querySelector('.bouton-login');
let divLogin = document.querySelector('#popup-login');
let closeLogin = document.querySelector('#close-login');

let profilToLogs = document.querySelectorAll('.profilToLogin');

//outside the popup
let divCloseLogin = document.querySelector('.close-popup-login');

//variable dropdown PETIT ECRAN
let dropdownLogin = document.querySelector('#dropdown-login');

//Make visible on click :
if (typeof(btnLogin) != 'undefined' && btnLogin != null)
{
    btnLogin.addEventListener('click', (e)=>{
        MakeLoginVisible();
    })
}

if (typeof(dropdownLogin) != 'undefined' && dropdownLogin != null)
{
    dropdownLogin.addEventListener('click', (e)=>{
        MakeLoginVisible();
    })
}

if (typeof(profilToLogs) != 'undefined' && profilToLogs != null)
{
    profilToLogs.forEach(profilToLog =>{
        profilToLog.addEventListener('click', (e)=>{
            MakeLoginVisible();
        })
    })
    
}

function MakeLoginVisible(){
    divLogin.classList.remove('overlay');
    divLogin.classList.add('not-overlay');
}


//Hide on click :
if (typeof(closeLogin) != 'undefined' && closeLogin != null)
{
    closeLogin.addEventListener('click', (e)=>{
        MakeLoginHidden();
    })
}

function MakeLoginHidden(){
    divLogin.classList.remove('not-overlay');
    divLogin.classList.add('overlay');
}


//Hide on click outside the popup :
if (typeof(divCloseLogin) != 'undefined' && divCloseLogin != null)
{
    divCloseLogin.addEventListener('click', (e)=>{
        MakeLoginHidden();
    })
}