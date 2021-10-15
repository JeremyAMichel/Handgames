let carouselItems = document.querySelectorAll(".carousel-item");

// if (typeof carouselItems[0] !== 'undefined'){
//     carouselItems[0].classList.add('active');
// }

if (typeof(carouselItems[0]) != 'undefined' && carouselItems[0] != null)
{
    carouselItems[0].classList.add('active');
}

if (typeof(carouselItems) != 'undefined' && carouselItems != null)
{
    carouselItems.forEach( carouselItem =>{
        carouselItem.setAttribute('data-bs-interval',5000);
    })
}