<?php
class ASIENTO
{
    public $ID_SALA;
    public $ID_ASIENTO;
    public $ESTADO_ASIENTO;

    public function __construct($id_a, $id_sala, $estado)
    {
        $this->ID_SALA = $id_sala;
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
