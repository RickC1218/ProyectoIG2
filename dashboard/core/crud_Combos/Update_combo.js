var $N_Nombre_Combo = document.querySelector("#N_Nombre_Combo"),
    $N_Descripcion_Combo = document.querySelector("#N_Descripcion_Combo"),
    $N_Precio_Combo = document.querySelector("#N_Precio_Combo"),
    $N_Banner_Combo = document.querySelector("#N_Banner_Combo"),
    $N_EditarCombo = document.querySelector("#Editar_Combo"),
    $N_IdCombo;

// Una global para establecerla al rellenar el formulario y leerla al enviarlo


async function rellenarFormulario (idCombo) {

    const respuestaRaw = await fetch("../core/crud_Combos/obtener_combo_id.php?id=" + parseInt(idCombo));
    const Combo = await respuestaRaw.json();
    // Rellenar formulario
    $N_Nombre_Combo.value = Combo.NOMB_COMBO;
    $N_Descripcion_Combo.value = Combo.DESCRIP_COMBO;
    $N_Precio_Combo.value = Combo.PRECIO_COMBO;
    $N_Banner_Combo.value = Combo.IMG_COMBO;
    $N_IdCombo = Combo.ID_COMBO;
};




$N_EditarCombo.onclick = async () => {
    const N_Nombre_Combo = $N_Nombre_Combo.value,
        N_Descripcion_Combo = $N_Descripcion_Combo.value,
        N_Precio_Combo = $N_Precio_Combo.value,
        N_Banner_Combo = $N_Banner_Combo.value,
        N_Id_Combo = $N_IdCombo;
    
        if (!N_Nombre_Combo) {
            return Swal.fire({
                icon: "error",
                text: "Escribe el nombre del combo",
                timer: 700, 
            });
        }
        if (!N_Descripcion_Combo) {
            return Swal.fire({
                icon: "error",
                text: "Escribe la descripción del combo",
                timer: 700, 
            });
        }
        if (!N_Precio_Combo) {
            return Swal.fire({
                icon: "error",
                text: "Escribe el precio del combo",
                timer: 700, 
            });
        }
        if (!N_Banner_Combo) {
            return Swal.fire({
                icon: "error",
                text: "Escribe el path de banner combo",
                timer: 700, 
            });
        }

    const cargaUtil = {
        N_Nombre_Combo,
        N_Descripcion_Combo,
        N_Precio_Combo ,
        N_Banner_Combo,
        N_Id_Combo
    };

    const cargaUtilCodificada = JSON.stringify(cargaUtil);
    console.log(cargaUtilCodificada);


    try {
        const respuestaRaw = await fetch("../core/crud_Combos/Update_combo.php", {
            method:"PUT",
            body: cargaUtilCodificada,
        });
        // El servidor nos responderá con JSON
        const respuesta = await respuestaRaw.json();
        if (respuesta) {

            
            Swal.fire({
                icon: "success",
                text: "Combo Actualizado",
                timer: 700, // <- Ocultar dentro de 0.7 segundos
            });
            // Limpiamos el formulario
            $N_Descripcion_Combo.value = $N_Nombre_Combo.value = $N_Banner_Combo.value = $N_Precio_Combo.value= "";

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