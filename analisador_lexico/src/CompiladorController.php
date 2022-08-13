<?php

namespace src\Controller;

use src\Model\CompiladorModel;

/**
 * @author Roni Deringer
 */

$modelo = new CompiladorModel;
$classe = new CompiladorController('if (', $modelo);

$classe->principal($modelo);

class CompiladorController

{
    public function __construct($entrada, $modelo)
    {
        $modelo->setEntrada($entrada);
    }

    public function principal($modelo)
    {

        for ($i = 0; $i < strlen($modelo->getEstado()); $i++) {
            if (array_key_exists($modelo->getEntrada()[$i], $modelo->delta[$modelo->getEstado()])) {


                if ($i == 0) {
                    if (!validaPrimeiraLetra($modelo->getEntrada()[0], $modelo)) {
                        break;
                    }
                }
                var_dump($modelo->ESTADOS_FINAIS);

                $estado = $modelo->finais[$modelo->getEstado()][$modelo->getEntrada()[$i]];

                validaCarecterEspecial($modelo->getEntrada(), $i, $modelo);


                if (array_key_exists($modelo->getEstado(), $modelo->ESTADOS_FINAIS)) {
                    $tokens = [$modelo->getEntrada() => $modelo->ESTADOS_FINAIS[$modelo->ESTADOS]];
                    echo "<em><" . $modelo->ESTADOS_FINAIS[$modelo->getEstado()] . ' , ' . $modelo->getEntrada() . ">";
                    $modelo->setEstado('q0');
                }
            } else {
                echo "codigo invalido";
            }
        }
    } //fim function principal


    function validaPrimeiraLetra($primeiraLetra, $modelo)
    {
        if (array_key_exists($primeiraLetra, $modelo->CARECTERES_ESPECIAIS)) {
            echo "Codigo Invalido";
            return false;
        }
        return true;
    }

    function validaCarecterEspecial($entrada, $i, $modelo)
    { //nao ta aceitando o espaço como caracter especial e a logica ta errada(??????), tem q esperar pra pegar primeiro o proximo estado
        if (array_key_exists($modelo->getEntrada()[$i + 1], $modelo->CARECTERES_ESPECIAIS)) {

            $teste = $modelo->getEntrada()[$i + 1];
            $modelo->setToken([$modelo->getEntrada()[$i] => "Variavel"]);
            $modelo->setEstado('q0');
        }
    }
}

