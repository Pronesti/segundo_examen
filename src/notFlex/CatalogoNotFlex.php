<?php

/**
 * Nos han pedido reemplazar la herramienta para mantener
 * el catalogo de peliculas de NotFlex porque el original
 * es muy malo. Pero como es un cambio muy grande en nuestra
 * primera entrega no hay que entregar todas las funcionalidades.
 * 
 * Las funcionalidades que nos piden son:
 *  - Agregar peliculas nuevas
 *  - Agregar series nuevas
 *  - Poder sacar peliculas
 *  - Poder sacar series
 *  - Listar por categoria
 *  - Una funcion que te dice si existe el id de pelicula/serie
 * 
 * Las categorias se van a ir creando a medida que se agregan
 * peliculas o series, entonces si se agrega una serie con la
 * categoria "ciencia misteriosa" esta categoría empieza a
 * existir en ese momento.
 * 
 * Tendremos que pasar todos los tests y tratemos de quedar
 * bien porque es nuestro primer cliente importante!
 */

class CatalogoNotFlex
{
  /**
   * Esta funcion solo nos dice si existe la pelicula o serie con
   * el id que nos pasan
   */
  private $catalogoPeliculas = array();
  private $catalogoSeries = array();

  public function existeId($id)
  {
    return array_key_exists($id, $this->catalogoPeliculas) || array_key_exists($id, $this->catalogoSeries);
  }

  public function agregarSerie($id, $nombre, $cantidadCapitulos, $categoria)
  {
    if (!$this->existeId($id)) {
      $this->catalogoSeries[$id] = array($nombre, $cantidadCapitulos, $categoria);
      return true;
    }
    return false;
  }

  public function agrearPelicula($id, $nombre, $tiempo, $categoria)
  {
    if (!$this->existeId($id)) {
      $this->catalogoPeliculas[$id] = array($nombre, $tiempo, $categoria);
      return true;
    }
    return false;
  }

  public function sacarSerie($id)
  {
    if ($this->existeId($id)) {
      unset($this->catalogoSeries[$id]);
      return true;
    }
    return false;
  }

  public function sacarPelicula($id)
  {
    if ($this->existeId($id)) {
      unset($this->catalogoPeliculas[$id]);
      return true;
    }
    return false;
  }

  public function listarContenidoDeLaCategoria($categoria)
  {
    $pelis = array_filter($this->catalogoPeliculas, function ($v) use ($categoria) {
      return $v[2] == $categoria;
    });
    $series = array_filter($this->catalogoSeries, function ($v) use ($categoria) {
      return $v[2] == $categoria;
    });
    return array_merge($pelis, $series);
  }
}
