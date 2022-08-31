
// Inicio Crud Promos 

const $Descripcion_promo = document.querySelector("#Descripcion_Promo"),
    $Categoria_Promo = document.querySelector("#Categoria_Promo"),
    $Banner_Promo = document.querySelector("#Banner_Promo"),
    $GuardarPromo = document.querySelector("#Guardar_Promo");

$GuardarPromo.onclick = async () => {
    const Descripcion_promo = $Descripcion_promo.value,
        Categoria_Promo = $Categoria_Promo.value,
        Banner_Promo = $Banner_Promo.value;
    
    if (!Descripcion_promo) {
        return Swal.fire({
            icon: "error",
            text: "Escribe la descripción",
            timer: 700, 
        });
    }
    if (!Categoria_Promo) {
        return Swal.fire({
            icon: "error",
            text: "Escribe la Categoria",
            timer: 700, 
        });
    }
    if (!Banner_Promo) {
        return Swal.fire({
            icon: "error",
            text: "Escribe el path del banner",
            timer: 700, 
        });
    }
    

    const cargaUtil = {
        Descripcion_promo,
        Categoria_Promo,
        Banner_Promo
    };

    const cargaUtilCodificada = JSON.stringify(cargaUtil);
    console.log(cargaUtilCodificada);


    try {
        const respuestaRaw = await fetch("../core/crud_Promociones/Insert_promo.php", {
            method:"POST",
            body: cargaUtilCodificada,
        });
        // El servidor nos responderá con JSON
        const respuesta = await respuestaRaw.json();
        if (respuesta) {

            
            Swal.fire({
                icon: "success",
                text: "Promoción Guardada",
                timer: 700, // <- Ocultar dentro de 0.7 segundos
            });
            // Limpiamos el formulario
            $Descripcion_promo.value = $Categoria_Promo.value = $Banner_Promo.value = "";

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