<?php
if (!isset($_GET["id"])) {
    http_response_code(500);
    exit();
}

function eliminarPelicula($id)
{
    require "../../../Controller/BasedeDatos.php";
    $sentencia = $conexion->prepare("DELETE FROM PELICULA WHERE ID_PELICULA = ?");
    $count = 1;
    $refresh = $conexion->prepare("ALTER TABLE PELICULA AUTO_INCREMENT = 1 AND TRUNCATE PELICULA;");
    $refresh->execute();
    return $sentencia->execute([$id]);
}

$respuesta = eliminarPelicula($_GET["id"]);
echo json_encode($respuesta);