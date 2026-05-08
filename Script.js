const pirate = document.getElementById('player-image');
const bulle = document.getElementById('bulle-dialogue');

// Réaction basée sur l'énergie de la base de données
if (energy < 50) {
    pirate.src = "assets/luffystyle.png";
    bulle.innerText = "Je n'ai plus d'énergie... Viande !!";
} else {
    pirate.src = "assets/playerfocus.png";
    bulle.innerText = "Je suis en pleine forme pour le match !";
}