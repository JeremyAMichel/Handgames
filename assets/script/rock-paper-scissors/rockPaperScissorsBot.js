let rockdivbot = document.querySelector('.rockdivbot');
let paperdivbot = document.querySelector('.paperdivbot');
let scissorsdivbot = document.querySelector('.scissorsdivbot');

let winPlayer = 0;
let winBot = 0;

let firstColor = document.querySelector('#first-result');
let secondColor = document.querySelector('#second-result');
let thirdColor = document.querySelector('#third-result');
let nextRound = document.querySelector('.hidden-choice');
let buttonNextRound = document.querySelector('#next-round');

let cpt = 0;

// On execute ce script uniquement si la variable rockdivbot existe sur la page

if (typeof(rockdivbot) != 'undefined' && (rockdivbot) != null){
    // on ajoute les écouteurs d'évenements sur les boutons de choix du joueur
    rockdivbot.addEventListener('click', (e)=>{
       comparaison(choiceIa(),'pierre');

    })

    paperdivbot.addEventListener('click', (e)=>{
        comparaison(choiceIa(),'feuille');

    })

    scissorsdivbot.addEventListener('click', (e)=>{
        comparaison(choiceIa(),'ciseaux');

    })

    buttonNextRound.addEventListener('click',(e)=>{
        prepareNextRound();
    })

}
    // choix aleatoire de l'IA
function choiceIa(){
    let tempRand = Math.random();

    if(tempRand<1/3){
        return 'pierre';
    }
    if(tempRand>1/3 && tempRand<=2/3){
        return 'feuille';
    }
    if(tempRand>2/3){
        return 'ciseaux';
    }
}

function prepareNextRound(){
    nextRound.style.display='none';
}

function comparaison(choiceIa , choicePlayer){
    console.log(choicePlayer + ' VS ' + choiceIa);
    // on test l'égalité
    if(choiceIa==choicePlayer){
        console.log('Egalité');
    }
    // on test tout les cas ou le joueur a perdu
    if((choicePlayer == 'pierre' && choiceIa == 'feuille') ||
        (choicePlayer=='feuille' && choiceIa == 'ciseaux')||
        (choicePlayer == 'ciseaux' && choiceIa == 'pierre')){
        console.log('Vous avez perdu !');
        nextRound.style.display='block';
        winBot+=1;
        cpt+=1;
        if(cpt == 1){
            firstColor.classList.add('lose-result');
        }
        if(cpt == 2){
            secondColor.classList.add('lose-result');
        }
        if(cpt == 3){
            thirdColor.classList.add('lose-result');
        }

        if(winBot == 2){
            timeAnimationMobile3 = setTimeout(function() {
                console.log('Le bot vous a foudroyé');
                winBot=0;
                winPlayer=0;
                cpt=0;
            }, 300);
        }
    }
    // On test tout les cas ou le joueur a gagné
    if((choicePlayer == 'pierre' && choiceIa == 'ciseaux') ||
        (choicePlayer == 'feuille' && choiceIa == 'pierre')||
        (choicePlayer == 'ciseaux' && choiceIa == 'feuille')){
        console.log('Vous avez gagné !');
        nextRound.style.display='block';
        winPlayer+=1;
        cpt+=1;
        if(cpt == 1){
            firstColor.classList.add('win-result');
        }
        if(cpt == 2){
            secondColor.classList.add('win-result');
        }
        if(cpt == 3){
            thirdColor.classList.add('win-result');
        }
        if(winPlayer == 2){
            timeAnimationMobile3 = setTimeout(function() {
                console.log('Le bot vous a foudroyé');
                winBot=0;
                winPlayer=0;
                cpt=0;
            }, 300);
        }
    }
 }
