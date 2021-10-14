let carouselSlides = document.querySelectorAll('.carousel-slide');

carouselSlides[0].classList.add('active');
carouselSlides[1].classList.add('active');
carouselSlides[2].classList.add('active');

let first = 0;
let last = 2;

let nextArrow = document.querySelector('.next-carousel-shop');
let leftArrow = document.querySelector('.previous-carousel-shop');


//event fleche de droite
nextArrow.addEventListener('click', (e)=>{
    rollCarouselLeft(carouselSlides[first]);
})

function rollCarouselLeft(leftSlide){
    leftSlide.classList.remove('active');
    let orderNext = last+1;
    
    if(orderNext>5){
        orderNext-=6;   
    }
    
    carouselSlides[orderNext].classList.add('active');

    first++;
    if(first>5){
        first-=6;
    }
    
    last++;
    if(last>5){
        last-=6;
    }
}

//event fleche de gauche
leftArrow.addEventListener('click', (e)=>{
    rollCarouselRight(carouselSlides[last]);
})

function rollCarouselRight(rightSlide){
    rightSlide.classList.remove('active');
    let orderPrev = first-1;
    
    if(orderPrev<0){
        orderPrev+=6;   
    }

    carouselSlides[orderPrev].classList.add('active');

    first--;
    if(first<0){
        first+=6;
    }
    
    last--;
    if(last<0){
        last+=6;
    }
}