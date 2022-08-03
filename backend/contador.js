var cajaPelicula = document.getElementById('cajaPelicula');
var posterPelicula = document.getElementById('posterPelicula');
var trailerPelicula = document.getElementById('trailerPelicula');
var card = document.getElementById('tarjeta');
var infoPelicula = document.getElementById('infoPelicula');
contador = 0;

function visionCompleta(){
    if(contador == 0){
        infoPelicula.style.display = 'block';
        trailerPelicula.style.display = 'none';
        cajaPelicula.style.transition= 'all 300ms';
        infoPelicula.style.width = '80%';
        infoPelicula.style.float = 'center';
        card.style.float = 'left';
        card.style.width = '215px';
        card.style.height = '280px';
        contador = 1;
    } else {
        infoPelicula.style.display = 'none';
        trailerPelicula.style.display = 'none';
        cajaPelicula.style.transition= 'all 300ms';
        card.style.float = 'center';
        card.style.width = '100%';
        contador = 0;
    }
}

cajaPelicula.addEventListener('click', visionCompleta, true);