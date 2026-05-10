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

const ctx = document.getElementById('radarChart').getContext('2d');

const radarChart = new Chart(ctx, {
    type: 'radar',
    data: {
        labels: ['Points', 'Assists', 'Énergie', 'Vitesse', 'Mental'], // On complète avec des stats fictives ou DB
        datasets: [{
            label: 'Performances actuelles',
            data: [
                stats.points,
                stats.assists, 
                stats.energy_level,
                85, // Tu pourras ajouter ces colonnes en DB plus tard
                95  // Haki du conquérant
            ],
            backgroundColor: 'rgba(239, 35, 60, 0.2)', // Rouge Luffy transparent
            borderColor: '#EF233C', // Rouge Luffy
            borderWidth: 3,
            pointBackgroundColor: '#2B2D42'
        }]
    },
    options: {
        scales: {
            r: {
                suggestedMin: 0,
                suggestedMax: 100,
                ticks: { display: false }
            }
        }
    }
});
bulle.classList.add('show'); // Pour faire apparaître la bulle quand Luffy parle