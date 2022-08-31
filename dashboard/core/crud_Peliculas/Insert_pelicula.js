
// Inicio Crud Pelicula 

const $Nombre_Pelicula = document.querySelector("#Nombre_Pelicula"),
    $Actores_Principales = document.querySelector("#Actores_Principales"),
    $Actores_Secundarios = document.querySelector("#Actores_Secundarios"),
    $Idioma = document.querySelector("#Idioma"),
    $Estreno = document.querySelector("#Estreno"),
    $Banner_Pelicula = document.querySelector("#Banner_Pelicula"),
    $Duracion = document.querySelector("#Duracion"),
    $Sinopsis = document.querySelector("#Sinopsis"),
    $GuardarPelicula = document.querySelector("#Guardar_Pelicula");

$GuardarPelicula.onclick = async () => {
    const Nombre_Pelicula = $Nombre_Pelicula.value,
        Actores_Principales = $Actores_Principales.value,
        Actores_Secundarios = $Actores_Secundarios.value,
        Idioma = $Idioma.value,
        Estreno = $Estreno.value,
        Banner_Pelicula = $Banner_Pelicula.value,
        Duracion = $Duracion.value,
        Sinopsis = $Sinopsis.value;
    
    console.log(Nombre_Pelicula)
    if (!Nombre_Pelicula) {
        return Swal.fire({
            icon: "error",
            text: "Escribe el nombre de la Pelicula",
            timer: 700, 
        });
    }
    if (!Actores_Principales) {
        return Swal.fire({
            icon: "error",
            text: "Escribe los actores principales",
            timer: 700, 
        });
    }
    if (!Idioma) {
        return Swal.fire({
            icon: "error",
            text: "Escribe el Idioma",
            timer: 700, 
        });
    }
    if (!Banner_Pelicula) {
        return Swal.fire({
            icon: "error",
            text: "Escribe el path del banner",
            timer: 700, 
        });
    }
    if (!Estreno) {
        return Swal.fire({
            icon: "error",
            text: "Escribe la fecha de Estreno",
            timer: 700, 
        });
    }
    if (!$Duracion) {
        return Swal.fire({
            icon: "error",
            text: "Escribe la Duración",
            timer: 700, 
        });
    }
    if (!$Sinopsis) {
        return Swal.fire({
            icon: "error",
            text: "Escribe la Sinopsis",
            timer: 700, 
        });
    }     

    var cargaUtil = {
        Nombre_Pelicula,
        Actores_Principales,
        Actores_Secundarios,
        Idioma,
        Estreno,
        Banner_Pelicula,
        Duracion,
        Sinopsis
    };

    const cargaUtilCodificada = JSON.stringify(cargaUtil);
    console.log(cargaUtilCodificada);


    try {
        const respuestaRaw = await fetch("../core/crud_Peliculas/Insert_pelicula.php", {
            method:"POST",
            body: cargaUtilCodificada,
        });
        // El servidor nos responderá con JSON
        const respuesta = await respuestaRaw.json();
        if (respuesta) {

            
            Swal.fire({
                icon: "success",
                text: "Pelicula Guardada",
                timer: 700, // <- Ocultar dentro de 0.7 segundos
            });
            // Limpiamos el formulario
            $Nombre_Pelicula.value = $Actores_Principales.value = 
            $Actores_Secundarios.value = $Idioma.value = $Estreno.value = 
            $Banner_Pelicula.value = $Duracion.value = $Sinopsis.value = "";

            window.location.reload();
        } else {
            Swal.fire({
                icon: "error",
                text: "El servidor no envió una respuesta exitosa "+respuesta,
            });
        }
    } catch (e) {
        // En caso de que haya un error
        Swal.fire({
            icon: "error",
            title: "Error de servidor",
            text: "Inténtalo de nuevo. El error es: " + e,
        });
    }

   // Fin Crud Pelicula 
};