let actuButtons = document.querySelectorAll('.bouton-actu');
let actuOverlays = document.querySelectorAll('.overlay-actu');
let actuCloses = document.querySelectorAll('.close-actu');

let actuButtonCount = 1;
let actuOverlayCount = 1;
let actuCloseCount = 1;


//data-attribute which will allow you to open only the popup that the button concerns
actuButtons.forEach( actuButton =>{
    actuButton.setAttribute('data-actu-id','actu-'+actuButtonCount);
    actuButtonCount++;
})

//unique id to distinguish news popups from each other
actuOverlays.forEach( actuOverlay=>{
    actuOverlay.setAttribute('id','actu-'+actuOverlayCount);
    actuOverlayCount++;
})

//data-attribute which will allow you to close only the popup that the cross button concerns
actuCloses.forEach( actuClose =>{
    actuClose.setAttribute('data-actu-id','actu-'+actuCloseCount);
    actuCloseCount++;
})


//event which will use the data-attribute to trigger the opening of the concerned popup 
actuButtons.forEach( actuButton =>{
    actuButton.addEventListener('click' , (e)=>{
        makeActuVisible(actuButton.getAttribute('data-actu-id'));
    })
})

function makeActuVisible(id){
    let actu = document.querySelector('#'+id);
    actu.classList.remove('overlay');
    actu.classList.add('not-overlay');
}


//event which will use the data-attribute to trigger the closing of the popup concerned
actuCloses.forEach( actuClose =>{
    actuClose.addEventListener('click', (e)=>{
        makeActuHidden(actuClose.getAttribute('data-actu-id'));
    })
})

function makeActuHidden(id){
    let actu = document.querySelector('#'+id);
    actu.classList.remove('not-overlay');
    actu.classList.add('overlay');
}

