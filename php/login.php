<?php

    $email = isset($_POST['email']) ? $_POST['email']: '';
    $pswd = isset($_POST['pswd']) ? $_POST['pswd'] : '';
    require('conexion.php');


    $sql = "SELECT * FROM cliente WHERE NOMBRE_CLI='Erick'";
    $result = $conexion->query($sql);
    $resultado = $result -> fetchAll(PDO::FETCH_ASSOC);

    print_r($resultado['NUMCED_CLI']);
    echo 'ok';
?>