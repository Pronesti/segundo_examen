<?php
include_once("Concesionaria.php");
class Cachavrolet{
    private $total = 0;
    private $con;
    public function __construct($concesionaria){
        $this->con = $concesionaria;
    }
    public function agregarAutos($idReferencia, $marca, $modelo, $anio, $precio){
        return $this->con->agregarAutos($idReferencia, $marca, $modelo, $anio, $precio);
    }
    public function venderAutoMarca($marca){
        if ($marca == 'Cachavrolet'){
            $anterior = $this->con->totalGanado();
            $this->con->venderAutoMarca($marca);
            $despues =  $this->con->totalGanado();
            $this->total += $despues - $anterior;
        }else{
            return $this->con->venderAutoMarca($marca); 
        }
    }

    public function totalVentas(){
        return $this->total;
    }
}
