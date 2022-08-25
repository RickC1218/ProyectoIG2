<?php
class ASIENTO
{
    public $ID_SALA;
    public $X_COL_ASIENTO;
    public $Y_FIL_ASIENTO;
    public $ESTADO_ASIENTO;
    public $ID_ASIENTO;


    public function __construct($id_sala, $x, $y, $estado, $id_a)
    {
        $this->ID_SALA = $id_sala;
        $this->X_COL_ASIENTO = $x;
        $this->Y_FIL_ASIENTO = $y;
        $this->ESTADO_ASIENTO = $estado;
        $this->ID_ASIENTO = $id_a;
    }

    //para establecer el estado cuando el usaurio escoja los nuevos asientos
    public function set_estado($estado)
    {
        return $this->ESTADO_ASIENTO = $estado;
    }

    public function get_estado()
    {
        return $this->ESTADO_ASIENTO;
    }

    public function get_id_asiento()
    {
        return $this->ID_ASIENTO;
    }
}
