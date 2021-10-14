let carouselSlides = document.querySelectorAll('.carousel-slide');

carouselSlides[0].classList.add('active');
carouselSlides[1].classList.add('active');
carouselSlides[2].classList.add('active');



let nextArrow = document.querySelector('.next-carousel-shop');


//event fleche de droite
nextArrow.addEventListener('click', (e)=>{
    let carouselActives = document.querySelectorAll('.active');
    rollCarouselLeft(carouselActives[0]);
})

function rollCarouselLeft(leftSlide){
    leftSlide.classList.remove('active');
    let orderNext = parseInt(leftSlide.getAttribute('data-order'))+3;
    if(orderNext>5){
        orderNext-6;
    }
    carouselSlides[orderNext].classList.add('active');
}