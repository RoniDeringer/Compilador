<?php

namespace App\Controller;

use App\Model\CompiladorModel;


class CompiladorController extends CompiladorModel{


public function principal() {

    for ($i = 0; $i < strlen($this->getEstado()); $i++) {
        if (array_key_exists($this->getEntrada()[$i], $this->getDelta()[$this->getEstado()])) {

            
            if($i == 0){
                if(!validaPrimeiraLetra($this->getEntrada()[0], $this->getCaracteresEspeciais())){
                    break;
                }
            }

            $estado = $this->getDelta()[$this->getEstado()][$this->getEntrada()[$i]];

            validaCarecterEspecial($this->getEntrada(), $i, $this->getCaracteresEspeciais());




            if (array_key_exists($this->getEstado(), $this->getFinais())) {
                $tokens = [$this->getEntrada() => $this->getFinais()[$this->getEstado()]];
                echo "<em><" . $this->getFinais()[$this->getEstado()] . ' , ' . $this->getEntrada() . ">";
                $this->setEstado('q0');
            }
        } else {
            echo "codigo invalido";
        }
    }
}//fim function principal





function validaCarecterEspecial($entrada, $i)
{ //nao ta aceitando o espaço como caracter especial e a logica ta errada(??????), tem q esperar pra pegar primeiro o proximo estado
    if (array_key_exists($this->getEntrada()[$i + 1], $this->getCaracteresEspeciais())) {

        $teste = $this->getEntrada()[$i + 1];          
        $this->setToken([$this->getEntrada()[$i] => "Variavel"]);
        $this->setEstado('q0');
    }
}

function validaPrimeiraLetra($primeiraLetra, ){
    if(array_key_exists($primeiraLetra, $this->getCaracteresEspeciais())){
        echo "Codigo Invalido";
        return false;
    }
    return true;
}



}





