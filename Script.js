const pirate = document.getElementById('player-image');
const bulle = document.getElementById('bulle-dialogue');

//section personnage vue
const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {

            bulle.innerText = "Mes stats sont plus hautes que Grand Line!";

            pirate.src = "assets/luffystyle.png";
        }

    });

});

observer.observe(document.querySelector('#section-stats'));