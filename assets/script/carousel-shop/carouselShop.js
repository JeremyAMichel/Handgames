
let carouselSlides = document.querySelectorAll('.carousel-slide');

// affichage des 3 première slides
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

//indice de la première slide à l'initialisation
let first = 0;

//indice de la deuxième slide à l'initialisation
let last = 2;

//on ajoute les class css permettant de gérer l'ordre d'affichage des slides
addOrderClasses(first, last);

let nextArrow = document.querySelector('.next-carousel-shop');
let leftArrow = document.querySelector('.previous-carousel-shop');

//timer pour rendre le carousel un peu plus vivant, de sortes qu'il roll à gauche de manière régulière
let time;
setNewTimer();

let timeAnimation;
let timeAnimation2;
let timeAnimation3;

//variable permettant de gérer si une action est en cours -> pour éviter le spam d'event
let isAnimationPc = false;


//event fleche de droite
if (typeof(nextArrow) != 'undefined' && nextArrow != null)
{
    nextArrow.addEventListener('click', (e)=>{
        // l'event s'active uniquement si une animation n'est pas déjà en cours
        if (isAnimationPc) {
            return;
        }
        isAnimationPc = true;

        rollCarouselLeft(carouselSlides[first]);

        // clear le Timer et le relance
        setNewTimer();

        // l'animation dure 1000ms, on bloque donc toute autre animation pendant ce laps de temps
        setTimeout(function() {
            isAnimationPc = false;
        }, 1000);
    })
}

// fonction qui va permettre au carousel de rouler vers la gauche
function rollCarouselLeft(leftSlide){
    //sauvegarde de la slide de droite car "last" est incrémenté à la fin de la fonction et celà pose problème
    //pour les timeout qui utilise la slide de droite
    rightSlide = carouselSlides[last];

    //indice de la prochaine slide (celle que l'ont doit affiché après la slide la plus à droite à l'affichage)
    let orderNext = last+1;
    orderNext = biggerThanLength(orderNext);

    // next permet de preparer la slide à droite du carousel (elle est cachée par le overflow:hidden du carousel)
    carouselSlides[orderNext].classList.add('next');

    // smooth-trans permet d'avoir des transitions à l'affichage
    leftSlide.classList.add('smooth-trans');

    // soon décale la slide concerné (ici celle de gauche) vers la gauche, jusqu'à qu'elle soit entièrement 
    // cachée par le overflow hidden du carousel
    leftSlide.classList.add('soon');

    // on détermine quelle est la slide qui est affiché aumilieu lors de l'initialisation
    let mid = first+1;
    mid = biggerThanLength(mid);

    carouselSlides[mid].classList.add('smooth-trans');
    // soon-alt positionne la slide à l'endroit où se trouvait la slide qui la précédait
    carouselSlides[mid].classList.add('soon-alt');

    carouselSlides[last].classList.add('smooth-trans');
    carouselSlides[last].classList.add('soon-alt');

    if(timeAnimation != 'undefined'){
        clearTimeout(timeAnimation);
    }

    // au bout d'une seconde -> fonction qui retire les class css residuelle
    timeAnimation = setTimeout(function() {
        removeActiveAndSoonAndNextClassesXL(leftSlide, carouselSlides[mid], rightSlide, carouselSlides[orderNext]);
    }, 1000);

    if(timeAnimation2 != 'undefined'){
        clearTimeout(timeAnimation2);
    }

    // au bout d'une demi seconde -> fonction qui gère l'animation 
    timeAnimation2 = setTimeout(function() {
        changeOrders(leftSlide, carouselSlides[mid], rightSlide, carouselSlides[orderNext]);
    }, 500);

    // actualisation de l'indice de la première et dernière slide
    first++;
    first=biggerThanLength(first);

    last++;
    last=biggerThanLength(last);
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


// fonction qui va permettre au carousel de rouler vers la droite
function rollCarouselRight(rightSlide){
    // sauvegarde de la slide la plus à gauche car "first" va être incrémenté alors qu'une fonction dans un timeout
    // a besoin de cette slide
    leftSlide = carouselSlides[first];

    // indice de la slide précédent la slide la plus à gauche à l'affichage
    let orderPrev = first-1;
    orderPrev = lessThanZero(orderPrev);

    // prev permet de preparer la slide à gauche du carousel (elle est cachée par le overflow:hidden du carousel)   
    carouselSlides[orderPrev].classList.add('prev');

    rightSlide.classList.add('smooth-trans');

    // prev-soon décale la slide concernée (ici celle de droite) vers la droite, jusqu'à qu'elle soit 
    // entièrement cachée par le overflow hidden du carousel
    rightSlide.classList.add('prev-soon');

    // on détermine l'indice de la slide affiché au milieu à l'initialisation
    let mid = first+1;
    mid = biggerThanLength(mid);

    carouselSlides[mid].classList.add('smooth-trans');

    // prev-soon-alt permet à la slide concernée de se positionner là où se trouvait la slide qui la suivait
    carouselSlides[mid].classList.add('prev-soon-alt');

    leftSlide.classList.add('smooth-trans');
    leftSlide.classList.add('prev-soon-alt');

    if(timeAnimation != 'undefined'){
        clearTimeout(timeAnimation);
    }

    // fonction qui retire les classes residuelles
    timeAnimation = setTimeout(function() {
        removeActiveAndSoonAndNextClassesXLPrev(carouselSlides[orderPrev], rightSlide);
    }, 1000);

    if(timeAnimation2 != 'undefined'){
        clearTimeout(timeAnimation2);
    }

    // fonction qui gère l'animation des différentes slides
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
        mid=biggerThanLength(mid);

        carouselSlides[mid].classList.add('mid');
    }
}

//remove les classes permettant de déterminer l'ordre d'afficher des éléments du caroussel
function removeOrderClasses(first, last){
    carouselSlides[first].classList.remove('first');
    carouselSlides[last].classList.remove('last');

    let mid = first+1;
    mid=biggerThanLength(mid);

    carouselSlides[mid].classList.remove('mid');
}

//vérifie si la variable n'a pas dépassé une limite (plus petit que 0) et la corrige si c'est le cas
function lessThanZero(variable){
    if(variable<0){
        variable+=6;
    }

    return variable;
}

//vérifie si la variable n'a pas dépassé une limite (plus grand que length de carouselSlides) et la corrige si c'est le cas
function biggerThanLength(variable){
    if(variable>(carouselSlides.length-1)){
        variable-=carouselSlides.length;
    }

    return variable;
}

// clear l'ancien timer et en démarre un nouveau
function setNewTimer(){
 
    clearInterval(time);

    time = setInterval(nextSlide,7000);

}

// le timer active manuellement l'event qui fait rouler le carousel à gauche
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

// retire les class css résiduelles à la suite d'une animation
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

// gère l'animation vers la droite
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

// retire les class css residuelle suite à l'animation du carousel vers la droite
function removeActiveAndSoonAndNextClassesXLPrev(prevSlide, rightSlide){
    rightSlide.classList.remove('prev-soon');
    rightSlide.classList.remove('active');

    prevSlide.classList.remove('smooth-trans');
    prevSlide.classList.remove('prev');
}

// gère l'animation du carousel qui roule vers la droite
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