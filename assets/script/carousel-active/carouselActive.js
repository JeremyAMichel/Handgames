let carouselItems = document.querySelectorAll(".carousel-item");

//console.log(carouselItem);

if (typeof carouselItems[0] !== 'undefined'){
    carouselItems[0].classList.add('active');

   //carouselItem[0].setAttribute('data-bs-interval',5000);


}

//if (typeof carouselItem[1] !== 'undefined'){

  //  carouselItem[1].setAttribute('data-bs-interval',2000);

//}

carouselItems.forEach( carouselItem =>{
    carouselItem.setAttribute('data-bs-interval',5000);
})