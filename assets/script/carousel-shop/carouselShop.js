let carouselSlides = document.querySelectorAll('.carousel-slide');

carouselSlides[0].classList.add('active');
carouselSlides[1].classList.add('active');
carouselSlides[2].classList.add('active');

let first = 0;
let last = 2;

addOrderClasses(first, last);

let nextArrow = document.querySelector('.next-carousel-shop');
let leftArrow = document.querySelector('.previous-carousel-shop');

let time = setInterval(nextSlide,7000);
setNewTimer();


//event fleche de droite
nextArrow.addEventListener('click', (e)=>{
    rollCarouselLeft(carouselSlides[first]);
    setNewTimer();
})

function rollCarouselLeft(leftSlide){
    leftSlide.classList.remove('active');
    removeOrderClasses(first, last);
    let orderNext = last+1;
    
    orderNext=biggerThanFive(orderNext);
    
    carouselSlides[orderNext].classList.add('active');

    first++;
    first=biggerThanFive(first);
    
    last++;
    last=biggerThanFive(last);

    addOrderClasses(first, last);
}

//event fleche de gauche
leftArrow.addEventListener('click', (e)=>{
    rollCarouselRight(carouselSlides[last]);
    setNewTimer();
})

function rollCarouselRight(rightSlide){
    rightSlide.classList.remove('active');
    removeOrderClasses(first, last);
    let orderPrev = first-1;
    
    orderPrev=lessThanZero(orderPrev);

    carouselSlides[orderPrev].classList.add('active');

    first--;
    first=lessThanZero(first);
    
    last--;
    last=lessThanZero(last);

    addOrderClasses(first, last);
}

//ajoute les classes permettant de déterminer l'ordre d'afficher des éléments du caroussel
function addOrderClasses(first, last){
    carouselSlides[first].classList.add('first');
    carouselSlides[last].classList.add('last');

    let mid = first+1;
    mid=biggerThanFive(mid);

    carouselSlides[mid].classList.add('mid');
}

//remove les classes permettant de déterminer l'ordre d'afficher des éléments du caroussel
function removeOrderClasses(first, last){
    carouselSlides[first].classList.remove('first');
    carouselSlides[last].classList.remove('last');

    let mid = first+1;
    mid=biggerThanFive(mid);

    carouselSlides[mid].classList.remove('mid');
}

//vérifie si la variable n'a pas dépassé une limite (plus petit que 0) et la corrige si c'est le cas
function lessThanZero(variable){
    if(variable<0){
        variable+=6;
    }

    return variable;
}

//vérifie si la variable n'a pas dépassé une limite (plus grand que 5) et la corrige si c'est le cas
function biggerThanFive(variable){
    if(variable>5){
        variable-=6;
    }

    return variable;
}


function setNewTimer(){
    // if(typeof time !== 'undefined'){
    clearInterval(time);
    // }
    time = setInterval(nextSlide,7000);
    // return time;    
}

function nextSlide(){
    rollCarouselLeft(carouselSlides[first]);
}

