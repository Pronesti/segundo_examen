<?php
include_once("AutosAgregados.php");
class AutosVendidos
{
    private $contador = 0;
    private $con;
    public function __construct($concesionaria)
    {
        $this->con = $concesionaria;
    }
    public function agregarAutos($idReferencia, $marca, $modelo, $anio, $precio)
    {
        return $this->con->agregarAutos($idReferencia, $marca, $modelo, $anio, $precio);
    }
    public function venderAutoMarca($marca)
    {
        $this->contador += 1;
        return $this->con->venderAutoMarca($marca);
    }

    public function totalAutosAgregados()
    {
        return $this->con->totalAutosAgregados();
    }
    public function totalVentas()
    {
        return $this->con->totalVentas();
    }
    public function totalAutosVendidos()
    {
        return $this->contador;
    }
}
