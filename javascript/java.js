//variable globales
let compteur = 0; //compteur qui permet de connaitre l'image sur laquel on se trouve
let timer, elements, slides, slideWidth;

window.onload = () => {
    //on recupere le diaporama
    const diapo = document.querySelector('.diapo');

    elements = document.querySelector('.elements');

    //on clone la premire image
    let firstImage = elements.firstElementChild.cloneNode(true);

    //on injecte le clone a la fin u diapo
    elements.appendChild(firstImage);

    slides = Array.from(elements.children);

    //on recupere la largeur d'une slide
    slideWidth = diapo.getBoundingClientRect().width;

    //on recuupere les fleches
    let next = document.querySelector('#nav-d');
    let prev = document.querySelector('#nav-g');

    //on gere le click
    next.addEventListener('click', slideNext)
    prev.addEventListener('click', slidePrev)

    //on automatise le defilement
    timer = setInterval(slideNext, 2000);
}
/*
cette fonction fait defiler le diaporama vers la droite
*/

function slideNext(){
    //on incremente le compteur
    compteur++;
    elements.style.transition = '1s linear'

    let decal = -slideWidth * compteur;
    elements.style.transform =`translateX(${decal}px)`; 

    //on attend la fin de la transition et on rebobine de facon cache
    setTimeout(function(){
        if(compteur >= slides.length - 1){
            compteur = 0;
            elements.style.transition = 'unset';
            elements.style.transform = 'translateX(0)';
        }

    }, 1000);
}
/*
cette fonction fait defiler le diaporama vers la gauche 
*/

function slidePrev (){
    compteur--;
    elements.style.transition = '1s linear'

    if(compteur < 0){
        compteur = slides.length - 1;
        let decal = -slideWidth * compteur;
        elements.style.transition = 'unset';
        elements.style.transform =`translateX(${decal}px)`; 
        setTimeout(slidePrev, 1)
    }

    let decal = -slideWidth * compteur;
    elements.style.transform =`translateX(${decal}px)`; 

}