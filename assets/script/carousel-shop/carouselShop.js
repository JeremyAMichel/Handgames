
let carouselSlides = document.querySelectorAll('.carousel-slide');

if (typeof(carouselSlides[0]) != 'undefined' && carouselSlides[0] != null)
{
    carouselSlides[0].classList.add('active');
}
if (typeof(carouselSlides[1]) != 'undefined' && carouselSlides[1] != null)
{
    carouselSlides[1].classList.add('active');
}
if (typeof(carouselSlides[2]) != 'undefined' && carouselSlides[2] != null)
{
    carouselSlides[2].classList.add('active');
}

let first = 0;
let last = 2;

addOrderClasses(first, last);

let nextArrow = document.querySelector('.next-carousel-shop');
let leftArrow = document.querySelector('.previous-carousel-shop');

let time;
setNewTimer();

let timeAnimation;
let timeAnimation2;
let timeAnimation3;

let isAnimationPc = false;


//event fleche de droite
if (typeof(nextArrow) != 'undefined' && nextArrow != null)
{
    nextArrow.addEventListener('click', (e)=>{
        if (isAnimationPc) {
            return;
        }
        isAnimationPc = true;

        rollCarouselLeft(carouselSlides[first]);
        setNewTimer();

        setTimeout(function() {
            isAnimationPc = false;
        }, 1000);
    })
}

function rollCarouselLeft(leftSlide){

    rightSlide = carouselSlides[last];

    let orderNext = last+1;
    orderNext = biggerThanFive(orderNext);

    carouselSlides[orderNext].classList.add('next');

    leftSlide.classList.add('smooth-trans');
    leftSlide.classList.add('soon');

    let mid = first+1;
    mid = biggerThanFive(mid);

    carouselSlides[mid].classList.add('smooth-trans');
    carouselSlides[mid].classList.add('soon-alt');

    carouselSlides[last].classList.add('smooth-trans');
    carouselSlides[last].classList.add('soon-alt');

    if(timeAnimation != 'undefined'){
        clearTimeout(timeAnimation);
    }

    timeAnimation = setTimeout(function() {
        removeActiveAndSoonAndNextClassesXL(leftSlide, carouselSlides[mid], rightSlide, carouselSlides[orderNext]);
    }, 1000);

    if(timeAnimation2 != 'undefined'){
        clearTimeout(timeAnimation2);
    }

    timeAnimation2 = setTimeout(function() {
        changeOrders(leftSlide, carouselSlides[mid], rightSlide, carouselSlides[orderNext]);
    }, 500);

    first++;
    first=biggerThanFive(first);

    last++;
    last=biggerThanFive(last);


}

//event fleche de gauche
if (typeof(leftArrow) != 'undefined' && leftArrow != null)
{
    leftArrow.addEventListener('click', (e)=>{
        if (isAnimationPc) {
            return;
        }
        isAnimationPc = true;

        rollCarouselRight(carouselSlides[last]);
        setNewTimer();

        setTimeout(function() {
            isAnimationPc = false;
        }, 1000);
    })
}

function rollCarouselRight(rightSlide){
    leftSlide = carouselSlides[first];

    let orderPrev = first-1;
    orderPrev = lessThanZero(orderPrev);

    carouselSlides[orderPrev].classList.add('prev');

    rightSlide.classList.add('smooth-trans');
    rightSlide.classList.add('prev-soon');

    let mid = first+1;
    mid = biggerThanFive(mid);

    carouselSlides[mid].classList.add('smooth-trans');
    carouselSlides[mid].classList.add('prev-soon-alt');

    leftSlide.classList.add('smooth-trans');
    leftSlide.classList.add('prev-soon-alt');

    if(timeAnimation != 'undefined'){
        clearTimeout(timeAnimation);
    }

    timeAnimation = setTimeout(function() {
        removeActiveAndSoonAndNextClassesXLPrev(carouselSlides[orderPrev], leftSlide, carouselSlides[mid], rightSlide);
    }, 1000);

    if(timeAnimation2 != 'undefined'){
        clearTimeout(timeAnimation2);
    }

    timeAnimation2 = setTimeout(function() {
        changeOrdersPrev(carouselSlides[orderPrev], leftSlide, carouselSlides[mid], rightSlide);
    }, 500);

    first--;
    first=lessThanZero(first);

    last--;
    last=lessThanZero(last);
}

//ajoute les classes permettant de déterminer l'ordre d'afficher des éléments du caroussel
function addOrderClasses(first, last){
    if (typeof(carouselSlides[first]) != 'undefined' && carouselSlides[first] != null)
    {
        carouselSlides[first].classList.add('first');
        carouselSlides[last].classList.add('last');

        let mid = first+1;
        mid=biggerThanFive(mid);

        carouselSlides[mid].classList.add('mid');
    }
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
 
    clearInterval(time);

    time = setInterval(nextSlide,7000);

}

function nextSlide(){
    if (typeof(carouselSlides[first]) != 'undefined' && carouselSlides[first] != null)
    {
        if (isAnimationPc) {
            return;
        }
        isAnimationPc = true;

        rollCarouselLeft(carouselSlides[first]);

        setTimeout(function() {
            isAnimationPc = false;
        }, 1000);
    }
}

function removeActiveAndSoonAndNextClassesXL(leftSlide, midSlide, rightSlide, nextSlide){
    leftSlide.classList.remove('soon');
    leftSlide.classList.remove('active');

    midSlide.classList.add('still');

    rightSlide.classList.add('still');

    midSlide.classList.remove('soon-alt');

    rightSlide.classList.remove('soon-alt');

    nextSlide.classList.remove('next');
    nextSlide.classList.remove('smooth-trans');

    midSlide.classList.remove('still');

    rightSlide.classList.remove('still');
}

function changeOrders(leftSlide, midSlide, rightSlide, nextSlide){
    leftSlide.classList.remove('first');

    midSlide.classList.remove('mid');
    midSlide.classList.add('first');

    rightSlide.classList.remove('last');
    rightSlide.classList.add('mid');

    nextSlide.classList.add('last');
    nextSlide.classList.add('smooth-trans');
    nextSlide.classList.add('active');

    //remove transitions so the caroussel don't look like bugged
    leftSlide.classList.remove('smooth-trans');
    midSlide.classList.remove('smooth-trans');
    rightSlide.classList.remove('smooth-trans');
    
}

function removeNextClassXL(midSlide, rightSlide, nextSlide){
    midSlide.classList.remove('soon-alt');

    rightSlide.classList.remove('soon-alt');

    nextSlide.classList.remove('next');  
}

function removeActiveAndSoonAndNextClassesXLPrev(prevSlide, leftSlide, midSlide, rightSlide){
    rightSlide.classList.remove('prev-soon');
    rightSlide.classList.remove('active');

    prevSlide.classList.remove('smooth-trans');
    prevSlide.classList.remove('prev');
}

function changeOrdersPrev(prevSlide, leftSlide, midSlide, rightSlide){
    prevSlide.classList.add('first');

    leftSlide.classList.remove('first');
    leftSlide.classList.add('mid');

    midSlide.classList.remove('mid');
    midSlide.classList.add('last');

    //remove transitions so the caroussel don't look like bugged
    leftSlide.classList.remove('smooth-trans');
    midSlide.classList.remove('smooth-trans');
    rightSlide.classList.remove('smooth-trans');

    prevSlide.classList.add('smooth-trans');
    prevSlide.classList.add('active');

    midSlide.classList.remove('prev-soon-alt');

    leftSlide.classList.remove('prev-soon-alt');

    rightSlide.classList.remove('last');
    
}