
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
        $this->ID_SALA = $id_sala;
        $this->aforo = $aforo;
        $this->ESTADO_SALA = $estado;
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
                $Asientos[$i][$j] = new ASIENTO($id_sala, $i, $j, "vacio", $id_asiento);
                $estado = 0;
                $Insert = "INSERT INTO asiento (ID_ASIENTO,X_COL_ASIENTO,Y_FIL_ASIENTO,ID_SALA,ESTADO_ASIENTO) 
                VALUES (" . $id_asiento . "," . $i . "," . $j . "," . $id_sala . "," . $estado . ");";
                if (mysqli_query($con, $Insert)) {
                    echo "registrado con exito";
                } else {
                    echo "error" . $Insert . "<br>" . mysqli_error($con);
                }
                //echo '<button type="button" class="btn_Butaca" id='.$id_asiento.' onclick="btnChanger('.$id_asiento.')" >B'. $id_asiento.'</button>';

            }
            //echo '<br>';
        }
    }


    // public function set_Estado_by_ID($id){
    //     $n = $this->n_asientos;
    //     for ($i=0; $i < ($this->aforo/$n) ; $i++) {

    //         for ($j=0; $j <($n) ; $j++) { 
    //         if (($this->Asientos[$i][$j])->ID_ASIENTO  == $id && ($this->Asientos[$i][$j])->get_estado () == "vacio"){
    //             ($this->Asientos[$i][$j])->set_estado ("elegido");
    //             break;
    //         }
    //     }                
    //     }
    // }    

    // public function get_Estado_by_ID($id){
    //     $n = $this->n_asientos;
    //     for ($i=0; $i < ($this->aforo/$n) ; $i++) {

    //         for ($j=0; $j <($n) ; $j++) { 
    //         if (($this->Asientos[$i][$j])->ID_ASIENTO  == $id){
    //             echo " existe asiento con ese id con estado ".($this->Asientos[$i][$j])->get_estado ();
    //             break;
    //         }
    //     }                
    //     }    
    // }

    public static function get_Sala($id_sala)
    {
        require("BasedeDatos.php");
        //$id_sala=1;
        $sql = "SELECT * FROM `asiento` WHERE ID_SALA=${id_sala};";
        $result =  mysqli_query($con, $sql);
        $Asientos = mysqli_fetch_all($result, MYSQLI_ASSOC);
        if (mysqli_query($con, $sql)) {
        } else {
            echo "error " . $sql . "<br>" . mysqli_error($con);
        }
        foreach ($Asientos  as $asiento) {
            if ($asiento['ESTADO_ASIENTO'] == 0) {
                echo '<button type="button" class="btn_Butaca" id=' . $asiento['ID_ASIENTO'] . ' onclick="reservacion.toggle(this)" >B' . $asiento['ID_ASIENTO'] . '</button>';
            } else {
                echo '<button type="button" class="btn_Butaca taken" id=' . $asiento['ID_ASIENTO'] . ' onclick="reservacion.toggle(this)" >B' . $asiento['ID_ASIENTO'] . '</button>';
            }
        }
        return $Asientos;
    }

    public static function save($id_sala, $Asientos, $id_usuario)
    {
        require("BasedeDatos.php");
        foreach ($Asientos as $asiento) {
            $sql = "INSERT INTO `Reservaciones` (`id_asiento`, `id_sala`,`id_usuario`) 
            VALUES (" . $asiento . "," . $id_sala . "," . $id_usuario . ")";
            $sql2 = "UPDATE asiento 
            SET ESTADO_ASIENTO = 1 
            WHERE ID_ASIENTO = $asiento AND ID_SALA=$id_sala";
            if (mysqli_query($con, $sql)) {
            } else {
                echo "error " . $sql . "<br>" . mysqli_error($con);
            }
            if (mysqli_query($con, $sql2)) {
            } else {
                echo "error " . $sql2 . "<br>" . mysqli_error($con);
            }
        }

        return true;
    }
}
?>
