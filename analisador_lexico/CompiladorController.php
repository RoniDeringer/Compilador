<?php

namespace App\Controller;

use App\Model\CompiladorModel;

class CompiladorController{

public function principal(){
    for ($i = 0; $i < strlen($this->getEntrada()); $i++) {
        if (array_key_exists($entrada[$i], $delta[$estado])) {

            
            if($i == 0){
                if(!validaPrimeiraLetra($entrada[0], $caracteresEspeciais)){
                    break;
                }
            }

            $estado = $delta[$estado][$entrada[$i]];

            validaCarecterEspecial($entrada, $i, $caracteresEspeciais);




            if (array_key_exists($estado, $finais)) {
                $tokens = [$entrada => $finais[$estado]];
                echo "<em><" . $finais[$estado] . ' , ' . $entrada . ">";
                $estado = 'q0';
            }
        } else {
            echo "codigo invalido";
        }
    }
}//fim function principal





function validaCarecterEspecial($entrada, $i, $caracteresEspeciais)
{ //nao ta aceitando o espaço como caracter especial e a logica ta errada(??????), tem q esperar pra pegar primeiro o proximo estado
    if (array_key_exists($entrada[$i + 1], $caracteresEspeciais)) {

        $teste = $entrada[$i + 1];          
        $tokens = [$entrada[$i] => "Variavel"];
        $estado = 'q0';
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





}