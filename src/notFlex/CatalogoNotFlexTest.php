<?php
/**
 * 
 * Tareas:
 *  - Bajar composer
 *  - Instalar phpunit
 *  - Revisar los tests
 *  - Leer la explicación de la clase
 *  - Que pasen los tests
 *  - Conquistar el mundo
 *  - Aprobar el curso!
 * 
 */

use PHPUnit\Framework\TestCase;
require_once("CatalogoNotFlex.php");

final class CatalogoNotFlexTest extends TestCase
{

  public function testAgregarPelicula() {
    $catalogo = new CatalogoNotFlex();
    $catalogo->agrearPelicula(1122, "Loco por Mary", 120, 'risa');

    $this->assertTrue($catalogo->existeId(1122));
  }

  public function testAgregarSerie() {
    $catalogo = new CatalogoNotFlex();
    $catalogo->agregarSerie(1111, 'Friends', 100, 'terror');

    $this->assertTrue($catalogo->existeId(1111));
  }

  public function testNoExisteId() {
    $catalogo = new CatalogoNotFlex();

    $this->assertFalse($catalogo->existeId(1010));
  }

  public function testSacarPelicula() {
    $catalogo = new CatalogoNotFlex();
    $catalogo->agrearPelicula(1122, "Loco por Mary", 120, 'risa');
    $catalogo->agrearPelicula(1123, "Matrix", 140, 'policial');

    $this->assertTrue($catalogo->sacarPelicula(1122));
    $this->assertFalse($catalogo->existeId(1122));
    $this->assertTrue($catalogo->existeId(1123));
  }

  public function testSacarSerie() {
    $catalogo = new CatalogoNotFlex();
    $catalogo->agregarSerie(2233, 'Casados con hijos', 50, 'argentina');
    $catalogo->agregarSerie(2234, 'Black Mirrow', 23, 'tristeza');

    $this->assertTrue($catalogo->sacarSerie(2233));
    $this->assertFalse($catalogo->existeId(2233));
    $this->assertTrue($catalogo->existeId(2234));
  }

  public function testListando1Categoria() {
    $catalogo = new CatalogoNotFlex();
    $catalogo->agregarSerie(2233, 'Casados con hijos', 50, 'argentina');
    $catalogo->agregarSerie(2234, 'Black Mirrow', 23, 'tristeza');
    $catalogo->agregarSerie(2235, 'Friendos', 800, 'risa');
    $catalogo->agrearPelicula(1122, "Loco por Mary", 120, 'risa');
    $catalogo->agrearPelicula(1123, "Matrix", 140, 'policial');

    $this->assertEquals(
      1,
      count($catalogo->listarContenidoDeLaCategoria('argentina'))
    );
  }

  public function testListarCategoriaQueNoExiste() {
    $catalogo = new CatalogoNotFlex();
    $catalogo->agregarSerie(2233, 'Casados con hijos', 50, 'argentina');
    $catalogo->agregarSerie(2234, 'Black Mirrow', 23, 'tristeza');
    $catalogo->agregarSerie(2235, 'Friendos', 800, 'risa');
    $catalogo->agrearPelicula(1122, "Loco por Mary", 120, 'risa');
    $catalogo->agrearPelicula(1123, "Matrix", 140, 'policial');

    $this->assertEquals(
      0,
      count($catalogo->listarContenidoDeLaCategoria('terror'))
    );
  }

  public function testListarCategorias() {
    $catalogo = new CatalogoNotFlex();
    $catalogo->agregarSerie(2233, 'Casados con hijos', 50, 'argentina');
    $catalogo->agregarSerie(2234, 'Black Mirrow', 23, 'tristeza');
    $catalogo->agregarSerie(2235, 'Friendos', 800, 'risa');
    $catalogo->agrearPelicula(1122, "Loco por Mary", 120, 'risa');
    $catalogo->agrearPelicula(1123, "Matrix", 140, 'policial');

    $this->assertEquals(
      0,
      count($catalogo->listarContenidoDeLaCategoria('terror'))
    );
    $this->assertEquals(
      1,
      count($catalogo->listarContenidoDeLaCategoria('tristeza'))
    );
    $this->assertEquals(
      1,
      count($catalogo->listarContenidoDeLaCategoria('policial'))
    );
    $this->assertEquals(
      2,
      count($catalogo->listarContenidoDeLaCategoria('risa'))
    );
  }
}