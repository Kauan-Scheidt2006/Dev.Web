<?php
class TrianguloIsoceles extends Triangulo {
    public function __construct($id = 0, $ladoA = 0, $ladoB = 0, $ladoC = 0, $cor = null, 
                                UnidadeMedida $un = null, $fundo = null, $trianguloTipo = null) {
        parent::__construct($id, $ladoA, $ladoB, $ladoC, $cor, $un, $fundo, $trianguloTipo);
    }

    // Método para calcular a área do triângulo isósceles
    public function calcularArea() {
        $base = $this->getLadoA();
        $altura = sqrt(pow($this->getLadoB(), 2) - pow($base / 2, 2));
        return round(($base * $altura) / 2, 3);
    }

    // Método para calcular o perímetro do triângulo isósceles
    public function calcularPerimetro() {
        return 2 * $this->getLadoB() + $this->getLadoA();
    }

    // Método para desenhar o triângulo isósceles
    public function desenhar() {
        return '
        <div style="width: 0; 
                    height: 0; 
                    border-left: ' . $this->getLadoA() / 2 . $this->getUnidade()->getDescricao() . ' solid transparent; 
                    border-right: ' . $this->getLadoA() / 2 . $this->getUnidade()->getDescricao() . ' solid transparent; 
                    border-bottom: ' . $this->getLadoB() . $this->getUnidade()->getDescricao() . ' solid ' . $this->getCor() . ';">
        </div>';
    }

    // Método para retornar o tipo de triângulo
    public function getTrianguloTipo() {
        return 'Isósceles';
    }

    // Método para desenvolver o cálculo da área
    public function desenvolverCalculoArea() {
        $base = $this->getLadoA();
        $altura = sqrt(pow($this->getLadoB(), 2) - pow($base / 2, 2));
        return "Área = (Base * Altura) / 2<br>" .
               "Base = " . $base . $this->getUnidade()->getDescricao() . "<br>" .
               "Altura = √(" . $this->getLadoB() . "² - (" . $base . " / 2)²) = " . round($altura, 3) . $this->getUnidade()->getDescricao() . "<br>" .
               "Área = (" . $base . " * " . round($altura, 3) . ") / 2 = " . $this->calcularArea() . " " . $this->getUnidade()->getDescricao() . "²";
    }

    // Método para desenvolver o cálculo do perímetro
    public function desenvolverCalculoPerimetro() {
        return "Perímetro = 2 * LadoB + Base<br>" .
               "Perímetro = 2 * " . $this->getLadoB() . " + " . $this->getLadoA() . "<br>" .
               "Perímetro = " . $this->calcularPerimetro() . " " . $this->getUnidade()->getDescricao();
    }
}
