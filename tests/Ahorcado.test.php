<?php
require_once("../vendor/autoload.php");
use \Source\Ahorcado;

use PHPUnit\Framework\TestCase; #namespace

final class AhorcadoTest extends TestCase{
    function testJugar(){
        $ahor= new Ahorcado("palabra", 5);
        $this->assertTrue($ahor->jugar("a"));
    }
    function testJugarDosVecesMismaLetra(){
        $ahor= new Ahorcado("palabra", 5);
        $this->assertTrue($ahor->jugar("a"));
        $this->assertFalse($ahor->jugar("a"));
    }
    function testJugarDosLetrasDiferentes(){
        $ahor= new Ahorcado("palabra", 5);
        $this->assertTrue($ahor->jugar("a"));
        $this->assertTrue($ahor->jugar("s"));
    }
    function testMostrarPalabra(){
        $ahor= new Ahorcado("palabra", 5);
        $this->assertIsString($ahor->mostrar());
        $this->assertSame(" _  _  _  _  _  _  _ ", $ahor->mostrar());
    }
    function testMostrarPalabraDespuesDeLetra(){
        $ahor= new Ahorcado("palabra", 5);
        $this->assertTrue($ahor->jugar("p"));
        $this->assertIsString($ahor->mostrar());
        $this->assertSame("p _  _  _  _  _  _ ", $ahor->mostrar());
    }
    function testMostrarPalabraDespuesGanar(){
        $ahor= new Ahorcado("palabra", 5);
        $this->assertTrue($ahor->jugar("p"));
        $this->assertTrue($ahor->jugar("a"));
        $this->assertTrue($ahor->jugar("l"));
        $this->assertTrue($ahor->jugar("b"));
        $this->assertTrue($ahor->jugar("r"));
        $this->assertIsString($ahor->mostrar());
        $this->assertSame("palabra", $ahor->mostrar());
    }
    function testIntentosRestantes(){
        $ahor= new Ahorcado("palabra", 5);
        $this->assertIsInt($ahor->intentosRestantes());
        $this->assertSame(5,$ahor->intentosRestantes());
    }
    function testIntentosRestantesJugandoBien(){
        $ahor= new Ahorcado("palabra", 5);
        $this->assertTrue($ahor->jugar("a"));
        $this->assertIsInt($ahor->intentosRestantes());
        $this->assertSame(5,$ahor->intentosRestantes());
    }
    function testIntentosRestantesJugandoMal(){
        $ahor= new Ahorcado("palabra", 5);
        $this->assertTrue($ahor->jugar("s"));
        $this->assertIsInt($ahor->intentosRestantes());
        $this->assertSame(4,$ahor->intentosRestantes());
    }
    function testIntentosRestantesJugandoMalDosVeces(){
        $ahor= new Ahorcado("palabra", 5);
        $this->assertTrue($ahor->jugar("s"));
        $this->assertTrue($ahor->jugar("j"));
        $this->assertIsInt($ahor->intentosRestantes());
        $this->assertSame(3,$ahor->intentosRestantes());
    }
    function testGano(){
        $ahor= new Ahorcado("palabra", 5);
        $this->assertTrue($ahor->jugar("p"));
        $this->assertTrue($ahor->jugar("a"));
        $this->assertTrue($ahor->jugar("l"));
        $this->assertTrue($ahor->jugar("b"));
        $this->assertTrue($ahor->jugar("r"));
        $this->assertIsBool($ahor->gano());
        $this->assertTrue($ahor->gano());
    }
    function testPerdio(){
        $ahor= new Ahorcado("palabra", 5);
        $this->assertTrue($ahor->jugar("z"));
        $this->assertTrue($ahor->jugar("j"));
        $this->assertTrue($ahor->jugar("t"));
        $this->assertTrue($ahor->jugar("x"));
        $this->assertTrue($ahor->jugar("k"));
        $this->assertIsBool($ahor->perdio());
        $this->assertTrue($ahor->perdio());
    }
    function testTerminoYGano(){
        $ahor= new Ahorcado("palabra", 5);
        $this->assertTrue($ahor->jugar("p"));
        $this->assertTrue($ahor->jugar("a"));
        $this->assertTrue($ahor->jugar("l"));
        $this->assertTrue($ahor->jugar("b"));
        $this->assertTrue($ahor->jugar("r"));
        $this->assertIsBool($ahor->termino());
        $this->assertTrue($ahor->termino());
    }
    function testTerminoYPerdio(){
        $ahor= new Ahorcado("palabra", 5);
        $this->assertTrue($ahor->jugar("z"));
        $this->assertTrue($ahor->jugar("j"));
        $this->assertTrue($ahor->jugar("t"));
        $this->assertTrue($ahor->jugar("x"));
        $this->assertTrue($ahor->jugar("k"));
        $this->assertIsBool($ahor->termino());
        $this->assertTrue($ahor->termino());
    }
    function testNoTermino(){
        $ahor= new Ahorcado("palabra", 5);
        $this->assertTrue($ahor->jugar("z"));
        $this->assertTrue($ahor->jugar("j"));
        $this->assertIsBool($ahor->termino());
        $this->assertFalse($ahor->termino());
    }


}