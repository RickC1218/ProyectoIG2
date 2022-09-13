<?php
require("ASIENTO.php");
include("BasedeDatos.php");

class SALA
{
    public $ID_SALA;
    public $ESTADO_SALA;
    public $aforo;
    public $n_asientos = 25;
    public $Asientos = array();

    public function __construct($id_sala, $aforo, $estado)
    {
        require("BasedeDatos.php");
        $this->ID_SALA = $id_sala;
        $this->aforo = $aforo;
        $this->ESTADO_SALA = $estado;

        // el crear una sala se inserta dicha sala en la base de datos

        $Insert = "INSERT INTO Sala Values (${id_sala},${aforo},${estado})";

        if (mysqli_query($con, $Insert)) {
            echo "registrado con exito";
        } else {
            echo "error" . $Insert . "<br>" . mysqli_error($con);
        }
    }

    //para establecer el estado cuando el usaurio escoja los nuevos asientos
    public function set_estado($estado)
    {
        return $this->ESTADO_SALA = $estado;
    }

    public function get_estado()
    {
        return $this->ESTADO_SALA;
    }

    //Aforo de la sala

    public static function Aforo($id_sala, $aforo, $n_asientos)
    {
        require("BasedeDatos.php");
        $n = $n_asientos;
        $id_asiento = 0;
        for ($i = 0; $i < ($aforo / $n); $i++) {
            for ($j = 0; $j < ($n); $j++) {
                $id_asiento = $id_asiento + 1;
                $Asientos[$i][$j] = new ASIENTO($id_asiento, $id_asiento, "D");
                $estado = 0;
                $Insert = "INSERT INTO ASIENTO ( ID_ASIENTO, ID_SALA, DISPONIBILIDAD_ASIENTO) 
                VALUES (" . $id_asiento . "," . $id_sala . "," . $estado . ");";
                if (mysqli_query($con, $Insert)) {
                    echo "registrado con exito";
                } else {
                    echo "error" . $Insert . "<br>" . mysqli_error($con);
                }
            }
        }
    }

    public static function get_Sala($id_sala)
    {
        require("BasedeDatos.php");
        //$id_sala=1;
        $sql = "SELECT * FROM ASIENTO WHERE ID_SALA=${id_sala};";
        $result =  mysqli_query($con, $sql);
        $Asientos = mysqli_fetch_all($result, MYSQLI_ASSOC);
        if (mysqli_query($con, $sql)) {
        } else {
            echo "error " . $sql . "<br>" . mysqli_error($con);
        }
        foreach ($Asientos  as $asiento) {
            if ($asiento['DISPONIBILIDAD_ASIENTO'] == 0) {
                echo '<button type="button" class="btn_Butaca" id=' . $asiento['ID_ASIENTO'] . ' onclick="reservacion.toggle(this)" >B' . $asiento['ID_ASIENTO'] . '</button>';
            } else {
                echo '<button type="button" class="btn_Butaca taken" id=' . $asiento['ID_ASIENTO'] . ' onclick="reservacion.toggle(this)" >B' . $asiento['ID_ASIENTO'] . '</button>';
            }
        }
        return $Asientos;
    }

    public static function save($id_sala, $Asientos, $id_usuario, $costo)
    {
        $id_asiento = "";
        foreach ($Asientos as $asiento) {
            $id_asiento = $id_asiento . "-" . $asiento;
        }
        $id_funcion = 1;
        require("BasedeDatos.php");

        //Se crea la factura para incluir el detalle a nombre del usuario actual
        date_default_timezone_set('America/Lima');

        $fecha_compra = date('Y-m-d');
        $id_metodo_pago = "NULL";
        $id_promo = "NULL";

        $sql = "INSERT INTO FACTURA (ID_METPAGO, NUMCED_CLI, ID_PROMOCION, FECHCOMP_FACTURA, VALTOTAL_FACTURA)
                VALUES (" . $id_metodo_pago . "," . $id_usuario . "," . $id_promo . ",'" . $fecha_compra . "'," . $costo . ")";

        if (mysqli_query($con, $sql)) {
        } else {
            echo "error " . $sql . "<br>" . mysqli_error($con);
        }

        // Se extrae el id de fatcura del usuario actual 
        $sql1 = "SELECT MAX(ID_FACTURA) FROM FACTURA WHERE NUMCED_CLI =" . $id_usuario . " AND FECHCOMP_FACTURA = '" . $fecha_compra . "'";
        $factura = mysqli_query($con, $sql1);
        $id_factura = mysqli_fetch_array($factura, MYSQLI_NUM);
?>
        <script>
            // guarda en el local storage el valor total del detalle de la dulceria
            localStorage.setItem('id_factura', <?php echo $id_factura[0] ?>);
        </script>
<?php
        if (mysqli_query($con, $sql1)) {
        } else {
            echo "error " . $sql1 . "<br>" . mysqli_error($con);
        }

        // se crea el detalle pelicula 
        $sql2 = "INSERT INTO DETALLE_PELICULA (ID_FACTURA, ID_ASIENTO,ID_SALA,ID_FUNCION,NUMBOLETOS_DETPEL,COSTO_DETPEL) 
            VALUES (" . $id_factura[0] . "," . $id_asiento . "," . $id_sala . "," . $id_funcion . "," . count($Asientos) . "," . $costo . ")";
        if (mysqli_query($con, $sql2)) {
        } else {
            echo "error " . $sql2 . "<br>" . mysqli_error($con);
        }

        foreach ($Asientos as $asiento) {
            $sql3 = "UPDATE ASIENTO 
            SET DISPONIBILIDAD_ASIENTO = 1 
            WHERE ID_ASIENTO = $asiento AND ID_SALA=$id_sala";
            if (mysqli_query($con, $sql3)) {
            } else {
                echo "error " . $sql3 . "<br>" . mysqli_error($con);
            }
        }

        return true;
    }
}
?>