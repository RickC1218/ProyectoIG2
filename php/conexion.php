<?php

    $server= 'mysql:host=localhost;port=3306;dbname=topcine';
    $user ='root';
    $psw ='';

    try{

        $conexion   = new PDO($server,$user,$psw);

        $conexion ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conexion ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

    }catch (PDOException $error){
        echo $error->getMessage();
        die();
    }
