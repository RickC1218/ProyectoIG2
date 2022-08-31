var $N_Nombre_Pelicula = document.querySelector("#N_Nombre_Pelicula"),
    $N_Actores_Principales = document.querySelector("#N_Actores_Principales"),
    $N_Actores_Secundarios = document.querySelector("#N_Actores_Secundarios"),
    $N_Idioma = document.querySelector("#N_Idioma"),
    $N_Estreno = document.querySelector("#N_Estreno"),
    $N_Banner_Pelicula = document.querySelector("#N_Banner_Pelicula"),
    $N_Duracion = document.querySelector("#N_Duracion"),
    $N_Sinopsis = document.querySelector("#N_Sinopsis"),
    $N_EditarPelicula = document.querySelector("#N_Editar_Pelicula"),
    $N_ActualizarPelicula = document.querySelector("#Actualizar_Pelicula")
    $N_IdPelicula = "";

// Una global para establecerla al rellenar el formulario y leerla al enviarlo


async function rellenarFormulario (idPelicula) {

    const respuestaRaw = await fetch("../core/crud_Peliculas/obtener_pelicula_id.php?id=" + parseInt(idPelicula));
    const Pelicula = await respuestaRaw.json();
    // Rellenar formulario
    $N_Nombre_Pelicula.value = Pelicula.TITULO_PELICULA;
    $N_Actores_Principales.value = Pelicula.ACTPRIN_PELICULA;
    $N_Actores_Secundarios.value = Pelicula.ACTSECUN_PELICULA;
    $N_Idioma.value = Pelicula.IDIOMA_PELICULA;
    $N_Estreno.value = Pelicula.ESTRENO_PELICULA;
    $N_Banner_Pelicula.value = Pelicula.IMAGEN_PELICULA;
    $N_Duracion.value = Pelicula.DURACION_PELICULA;
    $N_Sinopsis.value = Pelicula.SINOPSIS_PELICULA;
    $N_IdPelicula=Pelicula.ID_PELICULA;
};




$N_ActualizarPelicula.onclick = async () => {
    var N_Nombre_Pelicula = $N_Nombre_Pelicula.value,
        N_Actores_Principales = $N_Actores_Principales.value,
        N_Actores_Secundarios = $N_Actores_Secundarios.value,
        N_Idioma = $N_Idioma.value,
        N_Estreno = $N_Estreno.value,
        N_Banner_Pelicula = $N_Banner_Pelicula.value,
        N_Duracion = $N_Duracion.value,
        N_Sinopsis = $N_Sinopsis.value,
        N_Id_Pelicula = $N_IdPelicula;
    
    if (!N_Nombre_Pelicula) {
        return Swal.fire({
            icon: "error",
            text: "Escribe el nombre de la Pelicula",
            timer: 700, 
        });
    }
    if (!N_Actores_Principales) {
        return Swal.fire({
            icon: "error",
            text: "Escribe la descripción",
            timer: 700, 
        });
    }
    if (!N_Idioma) {
        return Swal.fire({
            icon: "error",
            text: "Escribe el Idioma",
            timer: 700, 
        });
    }
    if (!N_Banner_Pelicula) {
        return Swal.fire({
            icon: "error",
            text: "Escribe el path del Banner",
            timer: 700, 
        });
    }
    if (!N_Estreno) {
        return Swal.fire({
            icon: "error",
            text: "Escribe la Fecha de Estreno",
            timer: 700, 
        });
    }
    if (!N_Duracion) {
        return Swal.fire({
            icon: "error",
            text: "Escribe la Duración",
            timer: 700, 
        });
    }
    if (!N_Sinopsis) {
        return Swal.fire({
            icon: "error",
            text: "Escribe la Duración",
            timer: 700, 
        });
    }     

    var cargaUtil = {
        N_Nombre_Pelicula,
        N_Actores_Principales,
        N_Actores_Secundarios,
        N_Idioma,
        N_Estreno,
        N_Banner_Pelicula,
        N_Duracion,
        N_Sinopsis,
        N_Id_Pelicula
    };

    var cargaUtilCodificada = JSON.stringify(cargaUtil);
    console.log(cargaUtilCodificada);


    try {
        const respuestaRaw = await fetch("/ProyectoIG2/dashboard/core/crud_Peliculas/Update_pelicula.php", {
            method:"PUT",
            body: cargaUtilCodificada,
        });
        // El servidor nos responderá con JSON
        const respuesta = await respuestaRaw.json();
        if (respuesta) {

            
            Swal.fire({
                icon: "success",
                text: "Pelicula Actualizada",
                timer: 700, // <- Ocultar dentro de 0.7 segundos
            });
            // Limpiamos el formulario
            $N_Nombre_Pelicula.value = $N_Actores_Principales.value = 
            $N_Actores_Secundarios.value = $N_Idioma.value = $N_Estreno.value = 
            $N_Banner_Pelicula.value = $N_Duracion.value = $N_Sinopsis.value = "";

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