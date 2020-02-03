<?php

/**
 * "Concesionaria los mala onda"
 * 
 * Tenemos que implementar el sistema de venta de autos usados para los mismos
 * dueños que la empresa "La pizzeria los mala onda". Esta concesionaria en
 * particular le esta yendo muy bien más allá de la crisis porque tienen una
 * estrategia bastante peculiar. La estrategía consta ser ser lo más mala onda
 * que se pueda y siempre ofrecer el auto mas caro que tengan en stock.
 * No solo eso sino que siempre que un cliente muestra interes en un auto
 * inmediatamente se le hace el papelerio para venderle el auto más caro sin
 * que se entere el cliente.
 */

class Concesionaria {
  private $_autos = array();
  private $_totalGanado = 0;

  /**
   * Se agregan autos con idReferencia, si el id ya existe no lo agrega
   */
  public function agregarAutos($idReferencia, $marca, $modelo, $anio, $precio) {
    if (!empty($this->_autos[$idReferencia])) {
      return false;
    }

    $this->_autos[$idReferencia] = array(
      'id' => $idReferencia,
      'marca' => $marca,
      'modelo' => $modelo,
      'anio' => $anio,
      'precio' => $precio,
    );
    return true;
  }

  /**
   * Muestra todos los autos de cierta marca
   */
  public function mostrarAutosDeMarca($marca) {
    $out = array();
    foreach ($this->_autos as $auto) {
      if ($auto['marca'] == $marca) {
        $out[] = $auto;
      }
    }
    return $out;
  }

  /**
   * Al vender el auto de una marca, se elige el auto más caro de dicha
   * marca y lo vende.
   * 
   * Lo que devuelve es el precio de venta o 0 si no quedan autos de dicha marca
   */
  public function venderAutoMarca($marca) {
    $venta = array();
    foreach ($this->_autos as $auto) {
      if ($auto['marca'] == $marca && empty($venta)) {
        $venta = $auto;
      }
      if ($auto['marca'] == $marca && $venta['precio'] < $auto['precio']) {
        $venta = $auto;
      }
    }
    if (empty($venta)) {
      return false;
    }
    $this->_totalGanado += $venta['precio'];
    unset($this->_autos[$venta['id']]);
    return true;
  }

  /**
   * Este es el total de ganancias
   */
  public function totalGanado() {
    return $this->_totalGanado;
  }

}