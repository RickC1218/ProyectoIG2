<?php
    $idPromocion = isset($_POST['idPromo']) ? $_POST['idPromo'] : '';
    $tipoPromocion = isset($_POST['tipo-Promocion']) ? $_POST['tipo-Promocion'] : '';
    $descPromocion = isset($_POST['Desc-Promocion']) ? $_POST['Desc-Promocion'] : '';
    $imgPromocion = isset($_POST['img-Promocion']) ? $_POST['img-Promocion'] : '';


    try{
        $conexion   = new PDO('mysql:host=localhost;port=3306;dbname=topcine','root','');
        $conexion ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conexion ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

        //echo json_encode('Conexion exitosa');
        $pdo = $conexion ->prepare('INSERT INTO promocion(ID_PROMO, DES_PROMO, CATEGORIA_PROMOCION, IMG_PROMO) VALUES(?, ?, ?, ?)');
        $pdo->bindParam(1,$idPromocion);
        $pdo->bindParam(2,$tipoPromocion);
        $pdo->bindParam(3,$descPromocion);
        $pdo->bindParam(4,$imgPromocion);
        $pdo->execute() or die(print($pdo->errorInfo()));

        echo json_encode('true');

    }catch(PDOException $error){
        echo $error->getMessage();
        die();

    }


?>