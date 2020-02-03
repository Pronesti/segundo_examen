<?php
include_once("Cachavrolet.php");
class AutosAgregados{
    private $contador = 0;
    private $con;
    public function __construct($concesionaria){
        $this->con = $concesionaria;
    }
    public function agregarAutos($idReferencia, $marca, $modelo, $anio, $precio){
        $this->contador += 1;
        return $this->con->agregarAutos($idReferencia, $marca, $modelo, $anio, $precio);
    }
    public function venderAutoMarca($marca){
            return $this->con->venderAutoMarca($marca);
    }

    public function totalAutosAgregados(){
        return $this->contador;
    }
    public function totalVentas(){
        return $this->con->totalVentas();
    }
}
