let rockdivbot = document.querySelector('.rockdivbot');
let paperdivbot = document.querySelector('.paperdivbot');
let scissorsdivbot = document.querySelector('.scissorsdivbot');

let userSkin = document.querySelector('.handPlayerOne');
let botSkin = document.querySelector('.handPlayerTwo');

let winPlayer = 0;
let winBot = 0;

let firstColor = document.querySelector('#first-result');
let secondColor = document.querySelector('#second-result');
let thirdColor = document.querySelector('#third-result');
let nextRound = document.querySelector('.hidden-choice');
let buttonNextRound = document.querySelector('#next-round');

let cpt = 0;

let betweenRoundRPSbotText = document.querySelector('#between-round-RPS-bot-text');
let endGameMsg = document.querySelector('.endOfGameMsg');

let gameFinished = document.querySelector('.game-finished');

// On execute ce script uniquement si la variable rockdivbot existe sur la page

if (typeof(rockdivbot) != 'undefined' && (rockdivbot) != null){
    // on ajoute les écouteurs d'évenements sur les boutons de choix du joueur
    rockdivbot.addEventListener('click', (e)=>{
       comparaison(choiceIa(),'pierre');
       changeSkinFigure(userSkin, 'pierre');

    })

    paperdivbot.addEventListener('click', (e)=>{
        comparaison(choiceIa(),'feuille');
        changeSkinFigure(userSkin, 'feuille');

    })

    scissorsdivbot.addEventListener('click', (e)=>{
        comparaison(choiceIa(),'ciseaux');
        changeSkinFigure(userSkin, 'ciseaux');

    })

    buttonNextRound.addEventListener('click',(e)=>{
        prepareNextRound();
        changeSkinFigure(userSkin, 'pierre');
        changeSkinFigure(botSkin, 'pierre');
    })

}
    // choix aleatoire de l'IA
function choiceIa(){
    let tempRand = Math.random();

    if(tempRand<1/3){
        changeSkinFigure(botSkin, 'pierre');
        return 'pierre';
    }
    if(tempRand>1/3 && tempRand<=2/3){
        changeSkinFigure(botSkin, 'feuille');
        return 'feuille';
    }
    if(tempRand>2/3){
        changeSkinFigure(botSkin, 'ciseaux');
        return 'ciseaux';
    }
}

function prepareNextRound(){
    nextRound.classList.replace('d-flex','d-none');   
}

function comparaison(choiceIa , choicePlayer){
    // on test l'égalité
    if(choiceIa==choicePlayer){
        betweenRoundRPSbotText.innerHTML="Draw";
    }
    // on test tout les cas ou le joueur a perdu
    if((choicePlayer == 'pierre' && choiceIa == 'feuille') ||
        (choicePlayer =='feuille' && choiceIa == 'ciseaux')||
        (choicePlayer == 'ciseaux' && choiceIa == 'pierre')){
        betweenRoundRPSbotText.innerHTML="You lost this round ...";
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
                gameFinished.classList.replace('d-none','d-flex');
                endGameMsg.innerHTML='Le bot vous a foudroyé...';
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
        betweenRoundRPSbotText.innerHTML="You won this round !";
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
                gameFinished.classList.replace('d-none','d-flex');
                endGameMsg.innerHTML='Vous avez foudroyé le bot !';
                winBot=0;
                winPlayer=0;
                cpt=0;
            }, 300);
        }
    }

    nextRound.classList.replace('d-none','d-flex');
 }


 // fonction temporaire car le skin ne doit pas etre celui par defaut, mais celui équipé par l'utilisateur
function changeSkinFigure(skin, figure){
    if(figure==='pierre'){
        skin.src='/build/image/skins/default-skin/default-hand-rock.png';
    }

    if(figure==='feuille'){
        skin.src='/build/image/skins/default-skin/default-hand-paper.png';
    }

    if(figure==='ciseaux'){
        skin.src='/build/image/skins/default-skin/default-hand-scissors.png';
    }
}