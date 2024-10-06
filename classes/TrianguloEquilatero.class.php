<?php

class TrianguloEquilatero extends Triangulo {
    public function __construct($id = 0, $ladoA = 0, $ladoB = 0, $ladoC = 0, $cor = null, 
                                UnidadeMedida $un = null, $fundo = null, $trianguloTipo = null) {
        parent::__construct($id, $ladoA, $ladoB, $ladoC, $cor, $un, $fundo, $trianguloTipo);
    }

    // Método para calcular a área do triângulo equilátero
    public function calcularArea() {
        return round((sqrt(3) / 4) * pow($this->getLadoA(), 2), 3);
    }

    // Método para calcular o perímetro do triângulo equilátero
    public function calcularPerimetro() {
        return 3 * $this->getLadoA();
    }

    // Método para desenhar o triângulo equilátero
    public function desenhar() {
        return '
        <div style="width: 0; 
                    height: 0; 
                    border-left: ' . $this->getLadoA() . $this->getUnidade()->getDescricao() . ' solid transparent; 
                    border-right: ' . $this->getLadoA() . $this->getUnidade()->getDescricao() . ' solid transparent; 
                    border-bottom: ' . ($this->getLadoA() * sqrt(3) / 2) . $this->getUnidade()->getDescricao() . ' solid ' . $this->getCor() . ';">
        </div>';
    }

    // Método para retornar o tipo de triângulo
    public function getTrianguloTipo() {
        return 'Equilátero';
    }

    // Método para desenvolver o cálculo da área
    public function desenvolverCalculoArea() {
        return "Área = (√3 / 4) * Lado²<br>" .
               "Área = (√3 / 4) * " . $this->getLadoA() . "²<br>" .
               "Área = " . $this->calcularArea() . " " . $this->getUnidade()->getDescricao() . "²";
    }

    // Método para desenvolver o cálculo do perímetro
    public function desenvolverCalculoPerimetro() {
        return "Perímetro = 3 * Lado<br>" .
               "Perímetro = 3 * " . $this->getLadoA() . "<br>" .
               "Perímetro = " . $this->calcularPerimetro() . " " . $this->getUnidade()->getDescricao();
    }
}
