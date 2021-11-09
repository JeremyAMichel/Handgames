let rockdivbot = document.querySelector('.rockdivbot');
let paperdivbot = document.querySelector('.paperdivbot');
let scissorsdivbot = document.querySelector('.scissorsdivbot');

let winPlayer = 0;
let winBot = 0;

// On execute ce script uniquement si la variable rockdivbot existe sur la page

if (typeof(rockdivbot) != 'undefined' && typeof (rockdivbot) != null){
    // on ajoute les écouteurs d'évenements sur les boutons de choix du joueur
    rockdivbot.addEventListener('click', (e)=>{
       comparaison(choiceIa(),'pierre');

    })

    paperdivbot.addEventListener('click', (e)=>{// comparaison(choiceIa,'feuille');
        comparaison(choiceIa(),'feuille');

    })

    scissorsdivbot.addEventListener('click', (e)=>{
        comparaison(choiceIa(),'ciseaux');

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
        winBot+=1;
        if(winBot == 2){
            console.log('Le bot vous a foudroyé');
            winBot=0;
            winPlayer=0;
        }
    }
    // On test tout les cas ou le joueur a gagné
    if((choicePlayer == 'pierre' && choiceIa == 'ciseaux') ||
        (choicePlayer == 'feuille' && choiceIa == 'pierre')||
        (choicePlayer == 'ciseaux' && choiceIa == 'feuille')){
        console.log('Vous avez gagné !');
        winPlayer+=1;
        if(winPlayer==2){
            console.log('Vous avez foudroyé le bot');
            winPlayer=0;
            winBot=0;
        }
    }
 }