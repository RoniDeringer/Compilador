<?php

/**
 * @author Roni Deringer
 */

namespace src\Model;

class CompiladorModel{

    const ESTADOS = array('q0', 'q1', 'q2', 'q3', 'q4', 'q5', 'q6', 'q7', 'q8', 'q9', 'q10', 'q11', 'q12', 'q13', 'q14');

    const ESTADOS_FINAIS = array(
        'q2' => 'IF',
        'q4' => 'Número',
        'q7' => 'FOR',
        'q12' => 'WHILE',
        'q13' => 'PRINT',
        'q14' => '(',
        'q15' => ')',
        'q16' => '{',
        'q17' => '}',
        'q18' => '[',
        'q19' => ']',
        'q20' => '+',
        'q21' => '-',
        'q22' => '/',
        'q23' => '*',
        'q24' => '=',
        'q25' => '!',
        'q26' => '>',
        'q27' => '<',
    );
    
    const DELTA = array(
    
        'q0' => array('a' => 'q3', 'b' => 'q3', 'c' => 'q3', 'd' => 'q3', 'e' => 'q3', 'f' => 'q5', 'g' => 'q3', 'h' => 'q3', 'i' => 'q1', 'j' => 'q3', 'k' => 'q3', 'l' => 'q3', 'm' => 'q3', 'n' => 'q3', 'o' => 'q3', 'p' => 'q8', 'q' => 'q3', 'r' => 'q3', 's' => 'q3', 't' => 'q3', 'u' => 'q3', 'v' => 'q3', 'w' => 'q8', 'x' => 'q3', 'y' => 'q3', 'z' => 'q3', '0' => 'q4', '1' => 'q4', '2' => 'q4', '3' => 'q4', '4' => 'q4', '5' => 'q4', '6' => 'q4', '7' => 'q4', '8' => 'q4', '9' => 'q4', '(' => 'q14', ')' => 'q15', '{' => 'q16', '}' => 'q17', '[' => 'q18', ']' => 'q19', '+' => 'q20', '-' => 'q21', '/' => 'q22', '*' => 'q23', '=' => 'q24', '!' => 'q25', '>' => 'q26', '<' => 'q27'),
        'q1' => array('f' => 'q2', 'a' => 'q3', 'b' => 'q3', 'c' => 'q3', 'd' => 'q3', 'e' => 'q3', 'g' => 'q3', 'h' => 'q3', 'i' => 'q3', 'j' => 'q3', 'k' => 'q3', 'l' => 'q3', 'm' => 'q3', 'n' => 'q3', 'o' => 'q3', 'p' => 'q3', 'q' => 'q3', 'r' => 'q3', 's' => 'q3', 't' => 'q3', 'u' => 'q3', 'v' => 'q3', 'w' => 'q3', 'x' => 'q3', 'y' => 'q3', 'z' => 'q3', '0' => 'q3', '1' => 'q3', '2' => 'q3', '3' => 'q3', '4' => 'q3', '5' => 'q3', '6' => 'q3', '7' => 'q3', '8' => 'q3', '9' => 'q3'),
        'q2' => array('a' => 'q3', 'b' => 'q3', 'c' => 'q3', 'd' => 'q3', 'e' => 'q3', 'f' => 'q3', 'g' => 'q3', 'h' => 'q3', 'i' => 'q3', 'j' => 'q3', 'k' => 'q3', 'l' => 'q3', 'm' => 'q3', 'n' => 'q3', 'o' => 'q3', 'p' => 'q3', 'q' => 'q3', 'r' => 'q3', 's' => 'q3', 't' => 'q3', 'u' => 'q3', 'v' => 'q3', 'w' => 'q3', 'x' => 'q3', 'y' => 'q3', 'z' => 'q3', '0' => 'q3', '1' => 'q3', '2' => 'q3', '3' => 'q3', '4' => 'q3', '5' => 'q3', '6' => 'q3', '7' => 'q3', '8' => 'q3', '9' => 'q3'),
        'q3' => array('a' => 'q3', 'b' => 'q3', 'c' => 'q3', 'd' => 'q3', 'e' => 'q3', 'f' => 'q3', 'g' => 'q3', 'h' => 'q3', 'i' => 'q3', 'j' => 'q3', 'k' => 'q3', 'l' => 'q3', 'm' => 'q3', 'n' => 'q3', 'o' => 'q3', 'p' => 'q3', 'q' => 'q3', 'r' => 'q3', 's' => 'q3', 't' => 'q3', 'u' => 'q3', 'v' => 'q3', 'w' => 'q3', 'x' => 'q3', 'y' => 'q3', 'z' => 'q3', '0' => 'q3', '1' => 'q3', '2' => 'q3', '3' => 'q3', '4' => 'q3', '5' => 'q3', '6' => 'q3', '7' => 'q3', '8' => 'q3', '9' => 'q3', '(' => 'q14', ')' => 'q15', '{' => 'q16', '}' => 'q17', '[' => 'q18', ']' => 'q19', '+' => 'q20', '-' => 'q21', '/' => 'q22', '*' => 'q23', '=' => 'q24', '!' => 'q25', '>' => 'q26', '<' => 'q27'),
        'q4' => array('0' => 'q4', '1' => 'q4', '2' => 'q4', '3' => 'q4', '4' => 'q4', '5' => 'q4', '6' => 'q4', '7' => 'q4', '8' => 'q4', '9' => 'q4'),
        'q5' => array('o' => 'q6', 'a' => 'q3', 'b' => 'q3', 'c' => 'q3', 'd' => 'q3', 'e' => 'q3', 'g' => 'q3', 'h' => 'q3', 'i' => 'q3', 'j' => 'q3', 'k' => 'q3', 'l' => 'q3', 'm' => 'q3', 'n' => 'q3', 'p' => 'q3', 'q' => 'q3', 'r' => 'q3', 's' => 'q3', 't' => 'q3', 'u' => 'q3', 'v' => 'q3', 'w' => 'q3', 'x' => 'q3', 'y' => 'q3', 'z' => 'q3'),
        'q6' => array('r' => 'q7', 'a' => 'q3', 'b' => 'q3', 'c' => 'q3', 'd' => 'q3', 'e' => 'q3', 'g' => 'q3', 'h' => 'q3', 'i' => 'q3', 'j' => 'q3', 'k' => 'q3', 'l' => 'q3', 'm' => 'q3', 'n' => 'q3', 'o' => 'q3', 'p' => 'q3', 'q' => 'q3', 's' => 'q3', 't' => 'q3', 'u' => 'q3', 'v' => 'q3', 'w' => 'q3', 'x' => 'q3', 'y' => 'q3', 'z' => 'q3'),
        'q7' => array('a' => 'q3', 'b' => 'q3', 'c' => 'q3', 'd' => 'q3', 'e' => 'q3', 'f' => 'q3', 'g' => 'q3', 'h' => 'q3', 'i' => 'q1', 'j' => 'q3', 'k' => 'q3', 'l' => 'q3', 'm' => 'q3', 'n' => 'q3', 'o' => 'q3', 'p' => 'q3', 'q' => 'q3', 'r' => 'q3', 's' => 'q3', 't' => 'q3', 'u' => 'q3', 'v' => 'q3', 'w' => 'q3', 'x' => 'q3', 'y' => 'q3', 'z' => 'q3', '0' => 'q3', '1' => 'q3', '2' => 'q3', '3' => 'q3', '4' => 'q3', '5' => 'q3', '6' => 'q3', '7' => 'q3', '8' => 'q3', '9' => 'q3'),
        'q8' => array('h' => 'q9', 'r' => 'q9', 'a' => 'q3', 'b' => 'q3', 'c' => 'q3', 'd' => 'q3', 'e' => 'q3', 'f' => 'q3', 'g' => 'q3', 'i' => 'q3', 'j' => 'q3', 'k' => 'q3', 'l' => 'q3', 'm' => 'q3', 'n' => 'q3', 'o' => 'q3', 'p' => 'q3', 'q' => 'q3', 's' => 'q3', 't' => 'q3', 'u' => 'q3', 'v' => 'q3', 'w' => 'q3', 'x' => 'q3', 'y' => 'q3', 'z' => 'q3', '0' => 'q3', '1' => 'q3', '2' => 'q3', '3' => 'q3', '4' => 'q3', '5' => 'q3', '6' => 'q3', '7' => 'q3', '8' => 'q3', '9' => 'q3'),
        'q9' => array('i' => 'q10', 'n' => 'q11', 'a' => 'q3', 'b' => 'q3', 'c' => 'q3', 'd' => 'q3', 'e' => 'q3', 'f' => 'q3', 'g' => 'q3', 'h' => 'q3', 'j' => 'q3', 'k' => 'q3', 'l' => 'q3', 'm' => 'q3', 'o' => 'q3', 'p' => 'q3', 'q' => 'q3', 'r' => 'q3', 's' => 'q3', 't' => 'q3', 'u' => 'q3', 'v' => 'q3', 'w' => 'q3', 'x' => 'q3', 'y' => 'q3', 'z' => 'q3', '0' => 'q3', '1' => 'q3', '2' => 'q3', '3' => 'q3', '4' => 'q3', '5' => 'q3', '6' => 'q3', '7' => 'q3', '8' => 'q3', '9' => 'q3'),
        'q10' => array('l' => 'q11', 'i' => 'q9', 'a' => 'q3', 'b' => 'q3', 'c' => 'q3', 'd' => 'q3', 'e' => 'q3', 'f' => 'q3', 'g' => 'q3', 'h' => 'q3', 'j' => 'q3', 'k' => 'q3', 'm' => 'q3', 'n' => 'q3', 'o' => 'q3', 'p' => 'q3', 'q' => 'q3', 'r' => 'q3', 's' => 'q3', 't' => 'q3', 'u' => 'q3', 'v' => 'q3', 'w' => 'q3', 'x' => 'q3', 'y' => 'q3', 'z' => 'q3', '0' => 'q3', '1' => 'q3', '2' => 'q3', '3' => 'q3', '4' => 'q3', '5' => 'q3', '6' => 'q3', '7' => 'q3', '8' => 'q3', '9' => 'q3'),
        'q11' => array('e' => 'q12', 't' => 'q13', 'a' => 'q3', 'b' => 'q3', 'c' => 'q3', 'd' => 'q3', 'f' => 'q3', 'g' => 'q3', 'h' => 'q3', 'i' => 'q3', 'j' => 'q3', 'k' => 'q3', 'l' => 'q3', 'm' => 'q3', 'n' => 'q3', 'o' => 'q3', 'p' => 'q3', 'q' => 'q3', 'r' => 'q3', 's' => 'q3', 'u' => 'q3', 'v' => 'q3', 'w' => 'q3', 'x' => 'q3', 'y' => 'q3', 'z' => 'q3', '0' => 'q3', '1' => 'q3', '2' => 'q3', '3' => 'q3', '4' => 'q3', '5' => 'q3', '6' => 'q3', '7' => 'q3', '8' => 'q3', '9' => 'q3'),
        'q12' => array('a' => 'q3', 'b' => 'q3', 'c' => 'q3', 'd' => 'q3', 'e' => 'q3', 'f' => 'q3', 'g' => 'q3', 'h' => 'q3', 'i' => 'q3', 'j' => 'q3', 'k' => 'q3', 'l' => 'q3', 'm' => 'q3', 'n' => 'q3', 'o' => 'q3', 'p' => 'q3', 'q' => 'q3', 'r' => 'q3', 's' => 'q3', 't' => 'q3', 'u' => 'q3', 'v' => 'q3', 'w' => 'q3', 'x' => 'q3', 'y' => 'q3', 'z' => 'q3', '0' => 'q3', '1' => 'q3', '2' => 'q3', '3' => 'q3', '4' => 'q3', '5' => 'q3', '6' => 'q3', '7' => 'q3', '8' => 'q3', '9' => 'q3'),
    
    );
    
    const CARACTERES_ESPECIAIS =
        [
            'parenteses_aberto' => '(',
            'parenteses_fechado' => ')',
            'espaco' => ' ',
            'igual' => '=',
            'maior' => '>',
            'menor' => '<',
            'multiplicacao' => '*',
            'divisao' => '/',
            'subtracao' => '-',
            'adicao' => '+'
        ];
    
    
private $estado = 'q0';

private $entrada;

private $token;





public function __construct($entrada, $modelo){
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

























public function getEstado(){
    return $this->estado;
}   

public function setEstado(String $estado){
    return $this->estado = $estado;    
}

public function getEntrada(){
    return $this->entrada;
}   

public function setEntrada(array $entrada){
    return $this->entrada = $entrada;    
}

public function getToken(array $token){
    return $this->token;
}

public function setToken(array $token){
    return $this->token = $token;    
}
}