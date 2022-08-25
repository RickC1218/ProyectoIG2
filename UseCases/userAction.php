<?php
include '../Entities/DB.php';
$db = new DB();

if (isset($_POST['action_type']) && !empty($_POST['action_type'])) {
    if ($_POST['action_type'] == 'data') {
        $conditions['where'] = array('id' => $_POST['id']);
        $conditions['return_type'] = 'single';
        $user = $db->getRows($tblName, $conditions);
        echo json_encode($user);
    } elseif ($_POST['action_type'] == 'view') {
        $tblName = $_POST['table_bd']; // obtener nombre de la tabla
        $flag = 1; // ayuda a conocer si es un SNACK(0) o COMBO(1)

        if (!isset($_POST['tipo_snack'])) { // verificar si tipo_snack fue asignado
            $table = $db->getRows($tblName, array());
        } else {
            $tipo_snack = $_POST['tipo_snack'];
            $table = $db->getRows($tblName, array('where' => 'TIPO_SNACK = "' . $tipo_snack . '"'));
            $flag = 0;
        }
        $output = '';

        if (!empty($table)) {
            if ($flag == 0) { // snack
                foreach ($table as $row) {
                    $output .= '<div class="card col-sm-3 tarjeta">
                                    <img class="card-img-top" src="../' . $row["IMG_SNACK"] . '" alt="Card image">
                                    <div class="card-body col-auto text-center">
                                        <h4 class="card-title">' . $row['NOMBRE_SNACK'] . '</h4>
                                        <p class="card-text">$ ' . $row['PRECIO_SNACK'] . '</p>
                                        <a href="#" class="btn btn-primary" id = "S_' . $row['ID_SNACK'] . '" data-bs-toggle="modal" data-bs-target="#myModal" onclick="setItemCantidad(); getRowSpecific(this.id); setPrecioPopup()">Ver</a>
                                    </div>
                                </div>';
                }
            } else { // combo
                foreach ($table as $row) {
                    $output .= '<div class="card col-sm-3 tarjeta">
                                    <img class="card-img-top" src="../' . $row["IMG_COMBO"] . '" alt="Card image">
                                    <div class="card-body col-auto text-center">
                                        <h4 class="card-title">' . $row['NOMB_COMBO'] . '</h4>
                                        <p class="card-text">' . $row['DESCRIP_COMBO'] . '</p>
                                        <p class="card-text">$ ' . $row['PRECIO_COMBO'] . '</p>
                                        <a href="#" class="btn btn-primary" id="C_' . $row['ID_COMBO'] . '" data-bs-toggle="modal" data-bs-target="#myModal" onclick="setItemCantidad(); getRowSpecific(this.id); setPrecioPopup()">Ver</a>
                                    </div>
                                </div>';
                }
            }
            echo $output;
        } else {
            echo 'No product(s) found......';
        }
    } elseif ($_POST['action_type'] == 'viewSpecific') {
        $tblName = $_POST['table_bd']; // obtener nombre de la tabla
        $flag = 1; // ayuda a conocer si es un SNACK(0) o COMBO(1)
        $ID = $_POST['id'];

        // consultas para tarjeta del SNACK o COMBO
        if (!isset($_POST['tipo_snack'])) { // verificar si tipo_snack fue asignado caso contrario es COMBO
            $table = $db->getRows($tblName, array('where' => 'ID_COMBO = ' . $ID));
            $precioCS = $table[0]['PRECIO_COMBO'];
        } else {
            $tipo_snack = $_POST['tipo_snack'];
            $table = $db->getRows($tblName, array('where' => 'TIPO_SNACK = "' . $tipo_snack . '" AND ID_SNACK = ' . $ID));
            $flag = 0;
            $knowSnack = knowSnack($table[0]['NOMBRE_SNACK']);
            $precioCS = $table[0]['PRECIO_SNACK'];
        }
        $output = '';
?>
        <script>
            localStorage.setItem("precio_C_S", <?php echo $precioCS; ?>);
        </script>
<?php
        if (!empty($table)) {
            if ($flag == 0) { // snack
                $output .= '
                <div class="card col-md-5 tarjeta tarjetaPopUp">
                ';
                foreach ($table as $row) {
                    $output .= '
                        <img class="card-img-top" src="../' . $row['IMG_SNACK'] . '" alt="Card image">
                        <div class="card-body col-auto text-center">
                            <h4 class="card-title">' . $row['NOMBRE_SNACK'] . '</h4>
                        </div>
                    ';
                }
                $output .= '</div>';

                if ($knowSnack == 1) { // verificar si el snack tiene subtipos de snacks
                    $conditionsIJ = 'SNACK.ID_SNACK, SNACK.NOMBRE_SNACK, SNACK.PRECIO_SNACK, SUBTIPO_SNACK.ID_SUBTSNACK, SUBTIPO_SNACK.NOMB_SUBTSNACK';
                    $subConsInnerJoin = '
                    INNER JOIN SNACK_SUBTSNACK ON SNACK.ID_SNACK = SNACK_SUBTSNACK.ID_SNACK
                    INNER JOIN SUBTIPO_SNACK ON SUBTIPO_SNACK.ID_SUBTSNACK = SNACK_SUBTSNACK.ID_SUBTSNACK
                    ';
                    $consultaSubtSnack = $db->getRows($tblName, array('select' => $conditionsIJ, 'inner_join' => $subConsInnerJoin, 'where' => 'SNACK.ID_SNACK = ' . $ID));
                    $output .= '
                    <div class="col-md-7">
                        <div id="accordion">
                            <div class="card">
                                <div class="card-header">
                                    <a class="btn" data-bs-toggle="collapse" href="#collapseOne">
                                        <h2>' . $consultaSubtSnack[0]['NOMBRE_SNACK'] . '</h2>
                                        <p>Es necesario elegir uno</p>
                                    </a>
                                </div>
                                <div id="collapseOne" class="collapse show" data-bs-parent="#accordion">
                                    <div class="card-body">
                                        <div class="btn-group-vertical">
                    ';
                    foreach ($consultaSubtSnack as $rowS) {
                        $output .= '
                                            <button type="button" class="btn btn-primary botonPopup" id="botonPopup_' . $rowS['ID_SUBTSNACK'] . '" onclick="botonClick(this.id)">' . $rowS['NOMB_SUBTSNACK'] . '</button>';
                    }
                    $output .= '
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
                } else {
                    $output .= '
                    <div class="col-md-7">
                    </div>
                    ';
                }
            } else { // combos
                $output .= '
                <div class="card col-md-5 tarjeta tarjetaPopUp">
                ';
                foreach ($table as $row) {
                    $output .= '
                        <img class="card-img-top" src="../' . $row['IMG_COMBO'] . '" alt="Card image">
                        <div class="card-body col-auto text-center">
                            <h4 class="card-title">' . $row['NOMB_COMBO'] . '</h4>
                            <p class="card-text">' . $row['DESCRIP_COMBO'] . '</p>
                        </div>
                    ';
                }
                $output .= '</div>';

                $conditionsIJ = 'COMBOS.ID_COMBO, COMBOS.NOMB_COMBO, COMBOS.DESCRIP_COMBO, COMBOS.PRECIO_COMBO, SNACK.NOMBRE_SNACK, SUBTIPO_SNACK.ID_SUBTSNACK, SUBTIPO_SNACK.NOMB_SUBTSNACK';
                $subConsInnerJoin = '
                    INNER JOIN COMBOS_SNACK ON COMBOS.ID_COMBO = COMBOS_SNACK.ID_COMBO
                    INNER JOIN SNACK ON SNACK.ID_SNACK = COMBOS_SNACK.ID_SNACK
                    INNER JOIN SNACK_SUBTSNACK ON SNACK_SUBTSNACK.ID_SNACK = SNACK.ID_SNACK
                    INNER JOIN SUBTIPO_SNACK ON SUBTIPO_SNACK.ID_SUBTSNACK = SNACK_SUBTSNACK.ID_SUBTSNACK
                    ';
                $consultaSubt = $db->getRows($tblName, array('select' => $conditionsIJ, 'inner_join' => $subConsInnerJoin, 'where' => 'COMBOS.ID_COMBO = ' . $ID));
                $output .= '
                    <div class="col-md-7">
                        <div id="accordion">
                    ';
                $contador = 0;
                $nombreSnack = '';
                $flagCombo = 0;
                foreach ($consultaSubt as $rowS) {
                    if ($nombreSnack != $rowS['NOMBRE_SNACK']) {
                        $flagCombo = 1;
                        if ($flagCombo == 1 && $contador != 0) {
                            $output .= '
                                        </div>
                                    </div>
                                </div>
                            </div>
                            ';
                        }
                        $contador++;
                        $output .= '
                        <div class="card">
                                <div class="card-header">
                                    <a class="btn" data-bs-toggle="collapse" href="#collapse' . $contador . '">
                                        <h2>' . $rowS['NOMBRE_SNACK'] . '</h2>
                                        <p>Es necesario elegir uno</p>
                                    </a>
                                </div>
                                <div id="collapse' . $contador . '" class="collapse show" data-bs-parent="#accordion">
                                    <div class="card-body">
                                        <div class="btn-group-vertical">
                                            <button type="button" class="btn btn-primary botonPopup" id="botonPopup_' . $rowS['ID_SUBTSNACK'] . '" onclick="botonClick(this.id)">' . $rowS['NOMB_SUBTSNACK'] . '</button>';
                    } else {
                        $flagCombo = 0;
                        $output .= '
                                            <button type="button" class="btn btn-primary botonPopup" id="botonPopup_' . $rowS['ID_SUBTSNACK'] . '" onclick="botonClick(this.id)">' . $rowS['NOMB_SUBTSNACK'] . '</button>';
                    }
                    $nombreSnack = $rowS['NOMBRE_SNACK'];
                }
                $output .= '
                        </div>
                    </div>';
            }
            echo $output;
        } else {
            echo '';
        }
    } elseif ($_POST['action_type'] == 'add') {
        $tipo_prod = $_POST['tipo_prod']; // considerar ver si esta o no definido

        if ($tipo_prod == '0') { // snack
            $conditions = array(
                'columns' => 'ID_SNACK, ID_FACTURA, ID_SUBTSNACK, CANTIDAD_DETDUL, PRECIO_DETDUL'
            );

            $userData = array(
                'id' => $_POST['id'], // id combo o snack
                'id_factura' => $_POST['id_factura'],
                'ids_subtsnack' => $_POST['array_ids'],
                'cantidad_detdul' => $_POST['cantidad_detdul'],
                'precio' => $_POST['precio']
            );
        } else { // combos
            $conditions = array(
                'columns' => 'ID_FACTURA, ID_COMBO, ID_SUBTSNACK, CANTIDAD_DETDUL, PRECIO_DETDUL'
            );

            $userData = array(
                'id_factura' => $_POST['id_factura'],
                'id' => $_POST['id'], // id combo o snack
                'ids_subtsnack' => $_POST['array_ids'],
                'cantidad_detdul' => $_POST['cantidad_detdul'],
                'precio' => $_POST['precio']
            );
        }

        $table_bd = $_POST['table_bd'];

        $insert = $db->insert($table_bd, $conditions, $userData);
        echo ($insert == TRUE) ? 'ok' : 'err';
    } elseif ($_POST['action_type'] == 'viewDetalle_dulceria') { // ver detalle de la dulceria
        $conditionsIJ = 'FACTURA.NUMCED_CLI, COMBOS.NOMB_COMBO AS "NOMB_PROD", COMBOS.DESCRIP_COMBO AS "DESCRIP_PROD", DETALLE_DULCERIA.CANTIDAD_DETDUL, DETALLE_DULCERIA.PRECIO_DETDUL, DETALLE_DULCERIA.ID_DETDUL, COMBOS.IMG_COMBO AS "IMG_PROD"';
        $subConsInnerJoin = '
            INNER JOIN DETALLE_DULCERIA ON DETALLE_DULCERIA.ID_COMBO = COMBOS.ID_COMBO
            INNER JOIN FACTURA ON DETALLE_DULCERIA.ID_FACTURA = FACTURA.ID_FACTURA
                    ';
        $numCed = 1726639410;
        $op_crud_union = '
        SELECT FACTURA.NUMCED_CLI, SNACK.NOMBRE_SNACK AS "NOMB_PROD", SNACK.NOMBRE_SNACK AS "DESCRIP_PROD", DETALLE_DULCERIA.CANTIDAD_DETDUL, DETALLE_DULCERIA.PRECIO_DETDUL, DETALLE_DULCERIA.ID_DETDUL, SNACK.IMG_SNACK AS "IMG_PROD" FROM DETALLE_DULCERIA
        INNER JOIN SNACK ON DETALLE_DULCERIA.ID_SNACK = SNACK.ID_SNACK
        INNER JOIN FACTURA ON DETALLE_DULCERIA.ID_FACTURA = FACTURA.ID_FACTURA
        WHERE FACTURA.NUMCED_CLI = 1726639410 /*Filtra combos o snacks comprados según el usuario*/
        ';
        $tblName = 'COMBOS';
        $precioTotalDulceria = 0;
        $consultaSubtSnack = $db->getRows($tblName, array('select' => $conditionsIJ, 'inner_join' => $subConsInnerJoin, 'where' => 'FACTURA.NUMCED_CLI = ' . $numCed, 'union' => $op_crud_union));
        // verificar si la consulta esta vacia o no
        if (!empty($consultaSubtSnack)) {
            $output = '';
            foreach ($consultaSubtSnack as $value) {
                $output .= '
                    <div class="row tarjeta-carrito"">
                        <div class="col-md-3">
                            <img src="../' . $value['IMG_PROD'] . '" alt="agua">
                        </div>
                        <div class="col-md-6" >
                            <h3>' . $value['NOMB_PROD'] . '</h3>
                            <p>' . $value['DESCRIP_PROD'] . '</p>
                            <div class="btn-group">
                                <h1 class="cantidad">Cantidad: ' . $value['CANTIDAD_DETDUL'] . '</h1>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <h3>$ ' . $value['PRECIO_DETDUL'] . '</h3>
                            <a id="eliminar_' . $value['ID_DETDUL'] . '" onclick="deleteUser(this.id)">Eliminar</a>
                        </div>
                    </div>
                ';
                $precioTotalDulceria += (float)$value['PRECIO_DETDUL'];
            }
?>
        <script>
            // guarda en el local storage el valor total del detalle de la dulceria
            localStorage.setItem("precioTotalDulceria", <?php echo $precioTotalDulceria; ?>);
        </script>
<?php
            echo $output;
        } else {
            echo '';
        }
    } elseif ($_POST['action_type'] == 'delete') {
        if (!empty($_POST['id'])) {
            $condition = array('ID_DETDUL' => $_POST['id']);
            $delete = $db->delete($_POST['table_name'], $condition);
            echo $delete ? 'ok' : 'err';
        }
    }
    exit;
}

/* ver el snack, retorna 0 si es diferente de los snacks que poseen 
subtipos de snacks, caso contrario retorna 1*/
function knowSnack($snack)
{
    switch ($snack) {
        case 'BEBIDA MEDIANA': {
                return 1;
            }
        case 'BEBIDA GRANDE': {
                return 1;
            }
        case 'NACHOS': {
                return 1;
            }
        case 'CANGUIL MEDIANO': {
                return 1;
            }
        case 'CANGUIL GRANDE': {
                return 1;
            }
        default: {
                return 0;
            }
    }
}
