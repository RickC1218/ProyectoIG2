var $N_Descripcion_promo = document.querySelector("#N_Descripcion_Promo"),
    $N_Categoria_Promo = document.querySelector("#N_Categoria_Promo"),
    $N_Banner_Promo = document.querySelector("#N_Banner_Promo"),
    $N_ActualizarPromo = document.querySelector("#EditarPromo"),
    $N_IdPromo;

// Una global para establecerla al rellenar el formulario y leerla al enviarlo


async function rellenarFormulario (idPromo) {

    const respuestaRaw = await fetch("../core/crud_Promociones/obtener_promo_id.php?id=" + parseInt(idPromo));
    const Promo = await respuestaRaw.json();
    // Rellenar formulario
    $N_Descripcion_promo.value = Promo.DESCRIPCION_PROMOCION;
    $N_Categoria_Promo.value = Promo.CATEGORIA_PROMOCION;
    $N_Banner_Promo.value = Promo.IMG_PROMOCION;
    $N_IdPromo = Promo.ID_PROMOCION;
};

// Al incluir este script, llamar a la función inmediatamente


$N_ActualizarPromo.onclick = async () => {
    const N_Descripcion_promo = $N_Descripcion_promo.value,
        N_Categoria_Promo = $N_Categoria_Promo.value,
        N_Banner_Promo = $N_Banner_Promo.value,
        N_Id_Promo = $N_IdPromo;
    
        if (!N_Descripcion_promo) {
            return Swal.fire({
                icon: "error",
                text: "Escribe la Descripcion de la promo",
                timer: 700, 
            });
        }
        if (!N_Categoria_Promo) {
            return Swal.fire({
                icon: "error",
                text: "Escribe la categoria de la promo",
                timer: 700, 
            });
        }
        if (!N_Banner_Promo) {
            return Swal.fire({
                icon: "error",
                text: "Escribe el path banner promo",
                timer: 700, 
            });
        }

    const cargaUtil = {
        N_Descripcion_promo,
        N_Categoria_Promo,
        N_Banner_Promo,
        N_Id_Promo,
    };

    const cargaUtilCodificada = JSON.stringify(cargaUtil);
    console.log(cargaUtilCodificada);


    try {
        const respuestaRaw = await fetch("../core/crud_Promociones/Update_promo.php", {
            method:"POST",
            body: cargaUtilCodificada,
        });
        // El servidor nos responderá con JSON
        const respuesta = await respuestaRaw.json();
        if (respuesta) {

            
            Swal.fire({
                icon: "success",
                text: "Promoción Actualizada",
                timer: 700, // <- Ocultar dentro de 0.7 segundos
            });
            // Limpiamos el formulario
            $N_Descripcion_promo.value = $N_Categoria_Promo.value = $N_Banner_Promo.value = "";

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