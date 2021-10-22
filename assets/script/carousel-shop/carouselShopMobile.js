
let carouselSlidesMobile = document.querySelectorAll('.carousel-slide-mobile');

if (typeof(carouselSlidesMobile[0]) != 'undefined' && carouselSlidesMobile[0] != null)
{
    carouselSlidesMobile[0].classList.add('active');
}

let activeSlideMobile = 0;
let nextArrowMobile = document.querySelector('.next-carousel-shop-mobile');
let leftArrowMobile = document.querySelector('.previous-carousel-shop-mobile');

let timeMobile;
setNewTimerMobile();

let timeAnimationMobile;
let timeAnimationMobile2;
let timeAnimationMobile3;

let isAnimationMobile = false;

//event fleche de droite
if (typeof(nextArrowMobile) != 'undefined' && nextArrowMobile != null)
{
    nextArrowMobile.addEventListener('click', (e)=>{
        if (isAnimationMobile) {
            return;
        }
        isAnimationMobile = true;

        rollCarouselLeftMobile(carouselSlidesMobile[activeSlideMobile]);
        setNewTimerMobile();
 
        setTimeout(function() {
            isAnimationMobile = false;
        }, 1000);  
    })
}

function rollCarouselLeftMobile(activeSlide){
    let orderNextMobile = activeSlideMobile+1;
    orderNextMobile = biggerThanFiveMobile(orderNextMobile);

    carouselSlidesMobile[orderNextMobile].classList.add('next');
    
    activeSlide.classList.add('soon');

    setAnimationTimeout1(activeSlide);

    if(timeAnimationMobile2 != 'undefined'){
        clearTimeout(timeAnimationMobile2);
    }

    timeAnimationMobile2 = setTimeout(function() {
        activeNextSlide(carouselSlidesMobile[orderNextMobile]);
    }, 500);



    if(timeAnimationMobile3 != 'undefined'){
        clearTimeout(timeAnimationMobile3);
    }

    timeAnimationMobile3 = setTimeout(function() {
        // activeAnimationMobileTimers++;
        removeNextClass(carouselSlidesMobile[orderNextMobile]);
    }, 1000);

    // carouselSlidesMobile[orderNextMobile].classList.add('active');

    activeSlideMobile++;
    activeSlideMobile=biggerThanFiveMobile(activeSlideMobile);

}

//event fleche de gauche
if (typeof(leftArrowMobile) != 'undefined' && leftArrowMobile != null)
{
    leftArrowMobile.addEventListener('click', (e)=>{
        if (isAnimationMobile) {
            return;
        }
        isAnimationMobile = true;

        rollCarouselRightMobile(carouselSlidesMobile[activeSlideMobile]);
        setNewTimerMobile();

        setTimeout(function() {
            isAnimationMobile = false;
        }, 1000); 
    })
}

function rollCarouselRightMobile(activeSlide){

    let orderPrevMobile = activeSlideMobile-1;
    orderPrevMobile=lessThanZeroMobile(orderPrevMobile);

    carouselSlidesMobile[orderPrevMobile].classList.add('prev');

    activeSlide.classList.add('prev-soon');

    setAnimationTimeout1Alt(activeSlide);

    if(timeAnimationMobile2 != 'undefined'){
        clearTimeout(timeAnimationMobile2);
    }

    timeAnimationMobile2 = setTimeout(function() {
        activePrevSlide(carouselSlidesMobile[orderPrevMobile]);
    }, 500);
    
    if(timeAnimationMobile3 != 'undefined'){
        clearTimeout(timeAnimationMobile3);
    }

    timeAnimationMobile3 = setTimeout(function() {
        removePrevClass(carouselSlidesMobile[orderPrevMobile]);
    }, 1000);

    activeSlideMobile--;
    activeSlideMobile=lessThanZeroMobile(activeSlideMobile);

}


//vérifie si la variable n'a pas dépassé une limite (plus petit que 0) et la corrige si c'est le cas
function lessThanZeroMobile(variable){
    if(variable<0){
        variable+=6;
    }

    return variable;
}

//vérifie si la variable n'a pas dépassé une limite (plus grand que 5) et la corrige si c'est le cas
function biggerThanFiveMobile(variable){
    if(variable>5){
        variable-=6;
    }

    return variable;
}


function setNewTimerMobile(){
    // if(typeof time !== 'undefined'){
    // if (isAnimationMobile) {
    //     return;
    // }
    // isAnimationMobile = true;

    clearInterval(timeMobile);
    // }
    timeMobile = setInterval(nextSlideMobile,7000);
    // return time;

    // setTimeout(function() {
    //     isAnimationMobile = false;
    // }, 1000);  
}

function nextSlideMobile(){
    if (typeof(carouselSlidesMobile[activeSlideMobile]) != 'undefined' && carouselSlidesMobile[activeSlideMobile] != null)
    {
        if (isAnimationMobile) {
            return;
        }
        isAnimationMobile = true;

        rollCarouselLeftMobile(carouselSlidesMobile[activeSlideMobile]);

        setTimeout(function() {
            isAnimationMobile = false;
        }, 1000); 
    }
}

function removeActiveAndSoonClasses(activeSlide){
    activeSlide.classList.remove('soon');
    activeSlide.classList.remove('active');
}

function removeActiveAndPrevSoonClasses(activeSlide){
    activeSlide.classList.remove('prev-soon');
    activeSlide.classList.remove('active');
}

function activeNextSlide(nextSlide){
    nextSlide.classList.add('active');
}

function activePrevSlide(prevSlide){
    prevSlide.classList.add('active');
}

function removeNextClass(nextSlide){
    nextSlide.classList.remove('next');
}

function removePrevClass(prevSlide){
    prevSlide.classList.remove('prev');
}

function setAnimationTimeout1(activeSlide){
    if(timeAnimationMobile != 'undefined'){
        clearTimeout(timeAnimationMobile);
    }

    timeAnimationMobile = setTimeout(function() {
        removeActiveAndSoonClasses(activeSlide);
    }, 1000);
}

function setAnimationTimeout1Alt(activeSlide){
    if(timeAnimationMobile != 'undefined'){
        clearTimeout(timeAnimationMobile);
    }

    timeAnimationMobile = setTimeout(function() {
        removeActiveAndPrevSoonClasses(activeSlide);
    }, 1000);
}