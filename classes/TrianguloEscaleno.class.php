<?php

class TrianguloEscaleno extends Triangulo {
    public function __construct($id = 0, $ladoA = 0, $ladoB = 0, $ladoC = 0, $cor = null, 
                                UnidadeMedida $un = null, $fundo = null, $trianguloTipo = null) {
        parent::__construct($id, $ladoA, $ladoB, $ladoC, $cor, $un, $fundo, $trianguloTipo);
    }

    // Método para calcular a área do triângulo escaleno usando a fórmula de Heron
    public function calcularArea() {
        $s = $this->calcularPerimetro() / 2;
        return round(sqrt($s * ($s - $this->getLadoA()) * ($s - $this->getLadoB()) * ($s - $this->getLadoC())), 3);
    }

    // Método para calcular o perímetro do triângulo escaleno
    public function calcularPerimetro() {
        return $this->getLadoA() + $this->getLadoB() + $this->getLadoC();
    }

    // Método para desenhar o triângulo escaleno
    public function desenhar() {
        return '
        <div style="width: 0; 
                    height: 0; 
                    border-left: ' . $this->getLadoA() . $this->getUnidade()->getDescricao() . ' solid transparent; 
                    border-right: ' . $this->getLadoB() . $this->getUnidade()->getDescricao() . ' solid transparent; 
                    border-bottom: ' . $this->getLadoC() . $this->getUnidade()->getDescricao() . ' solid ' . $this->getCor() . ';">
        </div>';
    }

    // Método para retornar o tipo de triângulo
    public function getTrianguloTipo() {
        return 'Escaleno';
    }

    // Método para desenvolver o cálculo da área
    public function desenvolverCalculoArea() {
        $s = $this->calcularPerimetro() / 2;
        return "Área = √(s * (s - LadoA) * (s - LadoB) * (s - LadoC))<br>" .
               "Onde s = (LadoA + LadoB + LadoC) / 2 = " . round($s, 3) . "<br>" .
               "Área = √(" . round($s, 3) . " * (" . round($s - $this->getLadoA(), 3) . ") * (" . round($s - $this->getLadoB(), 3) . ") * (" . round($s - $this->getLadoC(), 3) . "))<br>" .
               "Área = " . $this->calcularArea() . " " . $this->getUnidade()->getDescricao() . "²";
    }

    // Método para desenvolver o cálculo do perímetro
    public function desenvolverCalculoPerimetro() {
        return "Perímetro = LadoA + LadoB + LadoC<br>" .
               "Perímetro = " . $this->getLadoA() . " + " . $this->getLadoB() . " + " . $this->getLadoC() . "<br>" .
               "Perímetro = " . $this->calcularPerimetro() . " " . $this->getUnidade()->getDescricao();
    }
}
