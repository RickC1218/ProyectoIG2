<?php
    $idPromocion = isset($_POST['IdPromo']) ? $_POST['IdPromo'] : '';
    $tipoPromocion = isset($_POST['tipo-Promocion']) ? $_POST['tipo-Promocion'] : '';
    $descPromocion = isset($_POST['Desc-Promocion']) ? $_POST['Desc-Promocion'] : '';
    $imgPromocion = isset($_POST['img-Promocion']) ? $_POST['img-Promocion'] : '';

    try{
        $conexion   = new PDO('mysql:host=localhost;port=3306;dbname=topcine','root','');
        $conexion ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conexion ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

        echo json_encode('Conexion exitosa');
        
    }catch(PDOException $error){
        echo $error->getMessage();
        die();

    }


?>