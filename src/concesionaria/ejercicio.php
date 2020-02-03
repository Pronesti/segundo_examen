<?php
/**
 * EJERCICIO
 * 
 * Tenemos un script que por algún poder misterioso del
 * universo no queremos modificarlo salvo que sea realmente
 * necesario.
 * 
 * En este script se hacen muchas compras y ventas de ciertos
 * autos, pero el genente Juan Carlos Mala Onda le parece que los
 * autos de marca Cachavrolet no le estan dando mucha ganancia.
 * Sin modificar el codigo nos gustaría saber el monto total de
 * ganancia que nos da la marca Cachavrolet.
 */
require_once("Concesionaria.php");
require_once("Cachavrolet.php");
require_once("AutosAgregados.php");
require_once("AutosVendidos.php");

srand(1000);

$marcas = array('FOR', 'Feat', 'Cachavrolet', 'Jonda', 'Tizan');

$concesionario = new AutosVendidos(new AutosAgregados(new Cachavrolet(new Concesionaria())));

// MODIFICAR ACA

// HASTA ACA

for($i=0; $i<500; $i++) {
  $n = rand(0, 4);
  $concesionario->agregarAutos($i, $marcas[$n], 'alguno', rand(1990, 2017), rand(100, 1000));
}

for($i=0; $i<20; $i++) {
  $n = rand(0, 4);
  $concesionario->venderAutoMarca($marcas[$n]);
}

// MODIFICAR ACA
// ---- imprimir ganancias por Cachavrolet ----
echo "Cachavrolet: $" .$concesionario->totalVentas();
echo "\n";
echo "Autos Agregados: " .$concesionario->totalAutosAgregados();
echo "\n";
echo "Autos vendidos: " . $concesionario->totalAutosVendidos();
echo "\n";
// Hasta aca