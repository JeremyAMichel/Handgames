
let carouselSlidesMobile = document.querySelectorAll('.carousel-slide-mobile');

// on affiche la première slide 
if (typeof(carouselSlidesMobile[0]) != 'undefined' && carouselSlidesMobile[0] != null)
{
    carouselSlidesMobile[0].classList.add('active');
}

// on garde une trace de l'indice de la slide affiché en temps réel
let activeSlideMobile = 0;
let nextArrowMobile = document.querySelector('.next-carousel-shop-mobile');
let leftArrowMobile = document.querySelector('.previous-carousel-shop-mobile');

// timer pour rendre le carousel un peu plus vivant -> trigger une animation de manière régulière
let timeMobile;
setNewTimerMobile();

let timeAnimationMobile;
let timeAnimationMobile2;
let timeAnimationMobile3;

// variable permettant de savoir si une animation est en cours
let isAnimationMobile = false;

//event fleche de droite
if (typeof(nextArrowMobile) != 'undefined' && nextArrowMobile != null)
{
    //on lance un event uniquement si une animation n'est pas déjà en cours
    nextArrowMobile.addEventListener('click', (e)=>{
        if (isAnimationMobile) {
            return;
        }
        isAnimationMobile = true;

        rollCarouselLeftMobile(carouselSlidesMobile[activeSlideMobile]);

        // fonction qui clear l'ancien timer et en set un nouveau (pour être sur que le timer se déclenche au bout
        // de xxx secondes d'INACTIVITE)
        setNewTimerMobile();
        
        // l'animation dure 1s au total, donc on bloque toute autre animation pendant 1s
        setTimeout(function() {
            isAnimationMobile = false;
        }, 1000);  
    })
}

//fonction qui s'occupe de faire rouler le carousel sur lui-même en direction de la gauche
function rollCarouselLeftMobile(activeSlide){

    // on récupère l'indice de la prochaine slide à afficher 
    let orderNextMobile = activeSlideMobile+1;
    orderNextMobile = biggerThanLengthMobile(orderNextMobile);

    // la class next permet de préparer la prochaine slide à l'affichage
    carouselSlidesMobile[orderNextMobile].classList.add('next');
    
    // la class soon permet de décaler la slide concernée vers la gauche jusqu'à ce qu'elle sorte entièrement
    // du carousel et soit donc caché par le overflow:hidden de ce dernier
    activeSlide.classList.add('soon');

    // un premier timer qui va supprimer les class css residuelles
    setAnimationTimeout1(activeSlide);

    if(timeAnimationMobile2 != 'undefined'){
        clearTimeout(timeAnimationMobile2);
    }

    // un second timer qui va afficher et faire venir de la droite la slide suivante
    timeAnimationMobile2 = setTimeout(function() {
        activeNextSlide(carouselSlidesMobile[orderNextMobile]);
    }, 500);


    if(timeAnimationMobile3 != 'undefined'){
        clearTimeout(timeAnimationMobile3);
    }

    // un dernier timer qui va supprimer les dernieres classes résiduelles
    timeAnimationMobile3 = setTimeout(function() {
        removeNextClass(carouselSlidesMobile[orderNextMobile]);
    }, 1000);

    // on met à jour l'indice de la slide active
    activeSlideMobile++;
    activeSlideMobile=biggerThanLengthMobile(activeSlideMobile);

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

// fonction pour gèrer le roulement du carousel sur lui-même en direction de la droite
function rollCarouselRightMobile(activeSlide){

    // indice de la prochaine slide à afficher
    let orderPrevMobile = activeSlideMobile-1;
    orderPrevMobile=lessThanZeroMobile(orderPrevMobile);

    // la class css prev permet de préparer la slide concerné à être affiché
    carouselSlidesMobile[orderPrevMobile].classList.add('prev');

    // la class css prev-soon décale la slide concerné vers la droite
    activeSlide.classList.add('prev-soon');

    // un premier timer qui va supprimer les class css residuelles
    setAnimationTimeout1Alt(activeSlide);

    if(timeAnimationMobile2 != 'undefined'){
        clearTimeout(timeAnimationMobile2);
    }

    // un second timer qui va afficher et faire venir de la droite la slide suivante
    timeAnimationMobile2 = setTimeout(function() {
        activePrevSlide(carouselSlidesMobile[orderPrevMobile]);
    }, 500);
    
    if(timeAnimationMobile3 != 'undefined'){
        clearTimeout(timeAnimationMobile3);
    }

    // un dernier timer qui va supprimer les dernieres classes résiduelles
    timeAnimationMobile3 = setTimeout(function() {
        removePrevClass(carouselSlidesMobile[orderPrevMobile]);
    }, 1000);

    // on met à jour l'indice de la slide active
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

//vérifie si la variable n'a pas dépassé une limite (plus grand que length de carouselSlidesMobile)
// et la corrige si c'est le cas
function biggerThanLengthMobile(variable){
    if(variable>(carouselSlidesMobile.length-1)){
        variable-=carouselSlidesMobile.length;
    }

    return variable;
}

//fonction qui clear l'ancien timer et en set un nouveau
function setNewTimerMobile(){

    clearInterval(timeMobile);

    timeMobile = setInterval(nextSlideMobile,7000);
  
}

//fonction déclenché par le timer ci-dessus -> permet de déclencher automatiquement l'event de roulement du 
//carousel vers la gauche
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

//retire les class css soon et active
function removeActiveAndSoonClasses(activeSlide){
    activeSlide.classList.remove('soon');
    activeSlide.classList.remove('active');
}

//retire les class css active et prev-soon
function removeActiveAndPrevSoonClasses(activeSlide){
    activeSlide.classList.remove('prev-soon');
    activeSlide.classList.remove('active');
}

// active la slide suivante
function activeNextSlide(nextSlide){
    nextSlide.classList.add('active');
}

//active la slide précédente
function activePrevSlide(prevSlide){
    prevSlide.classList.add('active');
}

// retire la class css next
function removeNextClass(nextSlide){
    nextSlide.classList.remove('next');
}

// retire la class css prev
function removePrevClass(prevSlide){
    prevSlide.classList.remove('prev');
}

// timer qui va permettre de retirer certaines des classes css résiduelles suite à une animation vers la gauche
function setAnimationTimeout1(activeSlide){
    if(timeAnimationMobile != 'undefined'){
        clearTimeout(timeAnimationMobile);
    }

    timeAnimationMobile = setTimeout(function() {
        removeActiveAndSoonClasses(activeSlide);
    }, 1000);
}

// timer qui va permettre de retirer certaines des classes css résiduelles sutie à une animation vers la droite
function setAnimationTimeout1Alt(activeSlide){
    if(timeAnimationMobile != 'undefined'){
        clearTimeout(timeAnimationMobile);
    }

    timeAnimationMobile = setTimeout(function() {
        removeActiveAndPrevSoonClasses(activeSlide);
    }, 1000);
}