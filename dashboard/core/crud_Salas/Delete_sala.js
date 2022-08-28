
    async function Eliminar_Usuario (idSala) {
            const respuestaConfirmacion = await Swal.fire({
                title: "Confirmación",
                text: "Esta Seguro de Eliminar, esta acción no se puede deshacer",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#3085d6',
                confirmButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
            });
            if (respuestaConfirmacion.value) {
                const url = "/ProyectoIG2/dashboard/core/crud_Salas/Delete_sala.php?id="+parseInt(idSala);
                const respuestaRaw = await fetch(url, {
                    method: "DELETE",
                });
                const respuesta = await respuestaRaw.json();
                if (respuesta) {
                    Swal.fire({
                        icon: "success",
                        text: "sala eliminada",
                        timer: 700, // <- Ocultar dentro de 0.7 segundos
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        text: "No se pudo eliminar",
                    });
                }
                window.location.reload();
            }
        }