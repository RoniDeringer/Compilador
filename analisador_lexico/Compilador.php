<?php

/**
 * @author Roni Deringer
 */

// $teste = new Compilador('a+');
 class Compilador
{

    const ESTADOS = array('q0', 'q1', 'q2', 'q3', 'q4', 'q5', 'q6', 'q7', 'q8', 'q9', 'q10', 'q11', 'q12', 'q13', 'q14');

    const ESTADOS_FINAIS = array(
        'q2' => 'IF',
        'q3' => 'VARIAVEL',
        'q4' => 'Número',
        'q7' => 'FOR',
        'q12' => 'WHILE',
        'q13' => 'PRINT',
        'q14' => 'abre_parenteses',
        'q15' => 'fecha_parenteses',
        'q16' => 'abre_chave',
        'q17' => 'fecha_chave',
        'q18' => 'abre_conhete',
        'q19' => 'fecha_conhete',
        'q20' => 'adição',
        'q21' => 'subtração',
        'q22' => 'divisão',
        'q23' => 'multiplicação',
        'q24' => 'igual',
        'q25' => 'diferente',
        'q26' => 'maior',
        'q27' => 'manor',
        'q28' => 'ESPAÇO',
    );

   const DELTA = array(

        'q0' => array('a' => 'q3', 'b' => 'q3', 'c' => 'q3', 'd' => 'q3', 'e' => 'q3', 'f' => 'q5', 'g' => 'q3', 'h' => 'q3', 'i' => 'q1', 'j' => 'q3', 'k' => 'q3', 'l' => 'q3', 'm' => 'q3', 'n' => 'q3', 'o' => 'q3', 'p' => 'q8', 'q' => 'q3', 'r' => 'q3', 's' => 'q3', 't' => 'q3', '' => 'q3', 'v' => 'q3', 'w' => 'q8', 'x' => 'q3', 'y' => 'q3', 'z' => 'q3', '0' => 'q4', '1' => 'q4', '2' => 'q4', '3' => 'q4', '4' => 'q4', '5' => 'q4', '6' => 'q4', '7' => 'q4', '8' => 'q4', '9' => 'q4', '(' => 'q14', ')' => 'q15', '{' => 'q16', '}' => 'q17', '[' => 'q18', ']' => 'q19', '+' => 'q20', '-' => 'q21', '/' => 'q22', '*' => 'q23', '=' => 'q24', '!' => 'q25', '>' => 'q26', '<' => 'q27', ' ' => 'q28'),
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

    private $entrada = '';

    private $token = [];

    private $lexema = '';



    public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado(string $estado)
    {
        return $this->estado = $estado;
    }

    public function getEntrada()
    {
        return $this->entrada;
    }

    public function setEntrada(string $entrada)
    {
        return $this->entrada = $entrada;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function setToken(array $token)
    {
        return $this->token = $token;
    }

    public function getLexema()
    {
        return $this->lexema;
    }

    public function setLexema($lexema)
    {
        return $this->lexema = $lexema;
    }


    public function __construct($entrada)
    {
        $this->setEntrada($entrada);
    }

/**
 * FAZER AJUSTES:
 *  1- Remover warnings
 *  2- Usar Regex
 *  3- Melhorar o visual
 *  4- 'a+'  considerando só +
 */

    public function principal()
    {
        $tokenAtual = [];
        $listTokens = [];
        $i = 0; 
        while ($i-1 < strlen($this->getEntrada())) {
            $lendo = $this->getEntrada()[$i];
            
            if(isset(Compilador::DELTA[$this->getEstado()][$this->getEntrada()[$i]])){
                $proximo_estado = Compilador::DELTA[$this->getEstado()][$this->getEntrada()[$i]] ?: '';
                $this->setEstado($proximo_estado); //$proximo_estado = null nao cai no catch
                $this->setLexema($this->getLexema() . $this->getEntrada()[$i]);
                $i++;

            }else{
                if (array_key_exists($this->getEstado(), Compilador::ESTADOS_FINAIS)) {
                    
                    $tokenAtual = array(Compilador::ESTADOS_FINAIS[$this->getEstado()] => $this->getLexema());
                    array_push($listTokens, $tokenAtual );
                    /*
                    foreach ($token_atual as $key => $value){
                        $teste[$key] = $value;
                    }
                    */
                    $this->setToken($listTokens);
                    $this->setEstado('q0');
                    $this->setLexema('');
                    
                } else {
                    echo "Código inválido!";
                    return true;
                }
            }
        }
    }
}