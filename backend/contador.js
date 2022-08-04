var cajaPelicula = document.getElementById('cajaPelicula');
var posterPelicula = document.getElementById('posterPelicula');
var trailerPelicula = document.getElementById('trailerPelicula');
var card = document.getElementById('tarjeta');
var infoPelicula = document.getElementById('infoPelicula');
contador = 0;

function visionCompleta(){
    if(contador == 0){
        trailerPelicula.style.display = 'none';
        trailerPelicula.style.width = 'auto';
        
        cajaPelicula.style.transition= 'all 300ms';
        cajaPelicula.style.width = 'auto';
        cajaPelicula.style.margin = 'auto';
        cajaPelicula.style.display = 'flex';
        cajaPelicula.style.justifyContent = 'center';

        infoPelicula.style.display = 'block';
        infoPelicula.style.width = 'auto';
        infoPelicula.style.float = 'auto';

        card.style.width = 'auto';
        card.style.float = 'auto';
        
        contador = 1;
    } else {
        trailerPelicula.style.display = 'none';
        
        cajaPelicula.style.transition= 'all 300ms';
        cajaPelicula.style.width = 'auto';
        
        infoPelicula.style.display = 'none';

        card.style.float = 'center';
        card.style.width = 'auto';

        contador = 0;
    }
}

cajaPelicula.addEventListener('click', visionCompleta, true);