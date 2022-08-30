
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
                $Asientos[$i][$j] = new ASIENTO($id_asiento,$id_asiento, "D");
                $estado = 0;
                $Insert = "INSERT INTO ASIENTO ( ID_ASIENTO, ID_SALA, DISPONIBILIDAD_ASIENTO) 
                VALUES (" . $id_asiento ."," . $id_sala . "," . $estado . ");";
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
        $id_asientos = "";
        $id_funcion=1;
        require("BasedeDatos.php");
        foreach ($Asientos as $asiento) {
            $id_asiento = $id_asiento .",". $asiento;
        }
            $sql = "INSERT INTO DETALLE_PELICULA (ID_FACTURA, ID_ASIENTO,ID_SALA,ID_FUNCION,NUMBOLETOS_DETPEL,COSTO_DETPEL) 
            VALUES (2," . $id_asiento . "," . $id_sala . ",".$id_funcion.",".count($Asientos).",".$costo.")";
            if (mysqli_query($con, $sql)) {
                
            } else {
                echo "error " . $sql . "<br>" . mysqli_error($con);
            }
            
            foreach ($Asientos as $asiento) {    
            $sql2 = "UPDATE ASIENTO 
            SET DISPONIBILIDAD_ASIENTO = 1 
            WHERE ID_ASIENTO = $asiento AND ID_SALA=$id_sala";
            if (mysqli_query($con, $sql2)) {
            } else {
                echo "error " . $sql2 . "<br>" . mysqli_error($con);
            }
        }

        return true;
    }
}
?>
