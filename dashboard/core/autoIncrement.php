<?php
    
    //setAutoIncrement(9,'COMBOS','ID_COMBO');
    /**
     * @param Objeto $conexion base de datos
     * @param int $id ID de la consulta
     * @param string $nombre_tabla tabla de la base de datos
     * @param string $pk nombre de la primary key de la base de datos
     */
    function setAutoIncrement($conexion, int $id, String $nombre_tabla, String $pk){

        //RECUPERO LOS ID DE TODOS LAS TABLAS
        $pdo = $conexion->prepare("SELECT $pk FROM $nombre_tabla WHERE $pk >= :id");
        $pdo ->bindParam(":id", $id);
        $pdo -> execute();
        $resultado = $pdo->fetchAll(PDO::FETCH_ASSOC); //CONVIERTO A UN ARREGLO EL RESULTADO

        for ($i = 0 ; $i < sizeof($resultado); $i++){ //ITERO PARA CADA ELEMENTO DEL ARREGLO
            //Actualizo los ID DE TODOS LOS ELEMENTOS DE LA TABLA EN FUNCION DEL ID ELIMINADO
            $pdo = $conexion->prepare("UPDATE $nombre_tabla SET $pk = $id WHERE $pk = :id");
            $id = $id + 1;
            $pdo ->bindParam(":id", ($id));
            $pdo -> execute();
        }
        //RECUPERO EL ID MAXIMO DE LA TABLA
        $pdo = $conexion->prepare("SELECT ($pk + 1) $pk FROM $nombre_tabla order by $pk desc limit 1;");
        $pdo -> execute();
        $resultado = $pdo->fetchAll(PDO::FETCH_ASSOC);
        //SETEO EL NUEVO VALOR AUTO_INCREMENT
        $aux = $resultado[0][$pk];
        $sql2 = "ALTER TABLE $nombre_tabla AUTO_INCREMENT  = $aux";
        $conexion->query($sql2);

        $pdo -> execute();
    }
