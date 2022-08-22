<?php
    $servidor = "mysql:dbname=topcine; host=localhost";
    $user = "root";
    $pwd = "";
    try {
        $pdo = new PDO($servidor, $user, $pwd, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    }catch(PDOException $e){
        echo "Conexión fallida ".$e->getMessage();
    }
?>