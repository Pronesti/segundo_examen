<?php
namespace Source;
class Ahorcado {

    private $palabraSecreta;
    private $intentos;
    private $letrasJugadas = array();

    function __construct($palabra, $intentos) {
        $this->palabraSecreta = $palabra;
        $this->intentos = $intentos;
    }

    function jugar($letra) {
        if (!in_array($letra, $this->letrasJugadas)) {
            $this->letrasJugadas[] = $letra;
            return true;
        }
        return false;
    }

    function mostrar() {
        $resultado = "";
        for($i=0; $i < strlen($this->palabraSecreta); $i++) {
            if (in_array($this->palabraSecreta[$i], $this->letrasJugadas)) {
                $resultado = $resultado . $this->palabraSecreta[$i];
            } else {
                $resultado = $resultado . " _ ";
            }
        }
        return $resultado;
    }

    public function intentosRestantes() {
        $resultado = $this->intentos;
        foreach($this->letrasJugadas as $letra) {
            if (strpos($this->palabraSecreta, $letra) === false) {
                $resultado -= 1;
            }
        }
        return $resultado;
    }

    function gano() {
        if ($this->intentosRestantes() <= 0) {
            return false;
        }
        for($i=0; $i < strlen($this->palabraSecreta); $i++) {
            if (!in_array($this->palabraSecreta[$i], $this->letrasJugadas)) {
                return false;
            }
        }
        return true;
    }

    function perdio() {
        if ($this->intentosRestantes() <= 0) {
            return true;
        }
        return false;
    }

    function termino() {
        if ($this->gano() || $this->perdio()) {
            return true;
        }
        return false;
    }
}
