<?php
    require('../Entities/conexion.php');

    $pdo = $conexion -> prepare("SELECT * FROM PROMOCION ORDER BY ID_PROMOCION ASC");
    $pdo -> execute();
    $resultado = $pdo -> fetchAll(PDO::FETCH_ASSOC);
    foreach($resultado as $data){
        echo "
            <div class='col-lg-3 col-md-6 mb-4 mb-md-0'>
                <img class='img-fluid  rounded-3'
                src='".$data['IMG_PROMOCION']. "' ". "alt='promocion' />
                <p>".$data['ID_PROMOCION'].". ".$data['DESCRIPCION_PROMOCION']."</p>
            </div>
        ";
    }

?>