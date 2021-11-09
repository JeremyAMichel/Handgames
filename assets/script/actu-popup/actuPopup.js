let actuButtons = document.querySelectorAll('.bouton-actu');
let actuOverlays = document.querySelectorAll('.overlay-actu');
let actuCloses = document.querySelectorAll('.close-actu');

//when you click outside the news popup
let actuCloseDivs = document.querySelectorAll('.close-popup-actu');

let actuButtonCount = 1;
let actuOverlayCount = 1;
let actuCloseCount = 1;
let actuCloseDivCount = 1;


//data-attribute which will allow you to open only the popup that the button concerns
if (typeof(actuButtons) != 'undefined' && actuButtons != null)
{
    actuButtons.forEach( actuButton =>{
        actuButton.setAttribute('data-actu-id','actu-'+actuButtonCount);
        actuButtonCount++;
    })
}

//unique id to distinguish news popups from each other
if (typeof(actuOverlays) != 'undefined' && actuOverlays != null)
{
    actuOverlays.forEach( actuOverlay=>{
        actuOverlay.setAttribute('id','actu-'+actuOverlayCount);
        actuOverlayCount++;
    })
}

//data-attribute which will allow you to close only the popup that the cross button concerns
if (typeof(actuCloses) != 'undefined' && actuCloses != null)
{
    actuCloses.forEach( actuClose =>{
        actuClose.setAttribute('data-actu-id','actu-'+actuCloseCount);
        actuCloseCount++;
    })
}

//data-attribute which will allow you to close only the pop that is open when you click outside of it
if (typeof(actuCloseDivs) != 'undefined' && actuCloseDivs != null)
{
    actuCloseDivs.forEach( actuCloseDiv =>{
        actuCloseDiv.setAttribute('data-actu-id','actu-'+actuCloseDivCount);
        actuCloseDivCount++;
    })
}


//event which will use the data-attribute to trigger the opening of the concerned popup
if (typeof(actuButtons) != 'undefined' && actuButtons != null)
{
    actuButtons.forEach( actuButton =>{
        actuButton.addEventListener('click' , (e)=>{
            makeActuVisible(actuButton.getAttribute('data-actu-id'));
        })
    })
}

function makeActuVisible(id){
    let actu = document.querySelector('#'+id);
    actu.classList.remove('overlay');
    actu.classList.add('not-overlay');
}


//event which will use the data-attribute to trigger the closing of the popup concerned
if (typeof(actuCloses) != 'undefined' && actuCloses != null)
{
    actuCloses.forEach( actuClose =>{
        actuClose.addEventListener('click', (e)=>{
            makeActuHidden(actuClose.getAttribute('data-actu-id'));
        })
    })
}

function makeActuHidden(id){
    let actu = document.querySelector('#'+id);
    
    actu.classList.remove('not-overlay');
    actu.classList.add('not-overlay-temp');

    let timeOut = setTimeout(function() {
        addOverlayClassToActuPopup(actu);
    },600);
}

function addOverlayClassToActuPopup(actu){
    actu.classList.add('overlay');
    actu.classList.remove('not-overlay-temp');
}

// event which will use the data-attribute to trigger the closing of the popup concerned
// when you click outside of the popup
if (typeof(actuCloseDivs) != 'undefined' && actuCloseDivs != null)
{
    actuCloseDivs.forEach( actuCloseDiv =>{
        actuCloseDiv.addEventListener('click', (e)=>{
            makeActuHidden(actuCloseDiv.getAttribute('data-actu-id'));
        })
    })
}