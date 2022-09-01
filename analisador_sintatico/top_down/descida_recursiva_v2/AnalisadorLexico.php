<?php

namespace src;

ini_set('display_errors', 0);
error_reporting(E_ERROR | E_WARNING | E_PARSE);

require_once('Token.php');

$lexico = new AnalisadorLexico();
$lexico->createListToken('if (');


class AnalisadorLexico
{
//IMPLEMENTAR O POS. FINAL E AS QUEBRAS DE LINHAS

    private const ESTADOS_FINAIS = array(
    'q2' => 'IF',
    'q3' => 'VARIAVEL',
    'q4' => 'Número',
    'q7' => 'FOR',
    'q11' => 'FUNCAO',
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
    'q29' => '',
    );

    private const DELTA = array(

    'q0' => array('a' => 'q3', 'b' => 'q3', 'c' => 'q3', 'd' => 'q3', 'e' => 'q3', 'f' => 'q5', 'g' => 'q3', 'h' => 'q3', 'i' => 'q1', 'j' => 'q3',
    'k' => 'q3', 'l' => 'q3', 'm' => 'q3', 'n' => 'q3', 'o' => 'q3', 'p' => 'q8', 'q' => 'q3', 'r' => 'q3', 's' => 'q3', 't' => 'q3', '' => 'q3',
    'v' => 'q3', 'w' => 'q8', 'x' => 'q3', 'y' => 'q3', 'z' => 'q3', '0' => 'q4', '1' => 'q4', '2' => 'q4', '3' => 'q4', '4' => 'q4', '5' => 'q4', '6' =>
    'q4', '7' => 'q4', '8' => 'q4', '9' => 'q4', '(' => 'q14', ')' => 'q15', '{' => 'q16', '}' => 'q17', '[' => 'q18', ']' => 'q19', '+' => 'q20', '-' =>
    'q21', '/' => 'q22', '*' => 'q23', '=' => 'q24', '!' => 'q25', '>' => 'q26', '<' => 'q27', ' ' => 'q28', '' => 'q28'),




    'q1' => array('f' => 'q2', 'a' => 'q3', 'b' => 'q3', 'c' => 'q3', 'd' => 'q3', 'e' => 'q3', 'g' => 'q3', 'h' => 'q3', 'i' => 'q3', 'j' => 'q3', 'k' => 'q3', 'l' => 'q3', 'm' => 'q3', 'n' => 'q3', 'o' => 'q3', 'p' => 'q3', 'q' => 'q3', 'r' => 'q3', 's' => 'q3', 't' => 'q3', 'u' => 'q3', 'v' => 'q3', 'w' => 'q3', 'x' => 'q3', 'y' => 'q3', 'z' => 'q3', '0' => 'q3', '1' => 'q3', '2' => 'q3', '3' => 'q3', '4' => 'q3', '5' => 'q3', '6' => 'q3', '7' => 'q3', '8' => 'q3', '9' => 'q3'),
    'q2' => array('a' => 'q3', 'b' => 'q3', 'c' => 'q3', 'd' => 'q3', 'e' => 'q3', 'f' => 'q3', 'g' => 'q3', 'h' => 'q3', 'i' => 'q3', 'j' => 'q3', 'k' => 'q3', 'l' => 'q3', 'm' => 'q3', 'n' => 'q3', 'o' => 'q3', 'p' => 'q3', 'q' => 'q3', 'r' => 'q3', 's' => 'q3', 't' => 'q3', 'u' => 'q3', 'v' => 'q3', 'w' => 'q3', 'x' => 'q3', 'y' => 'q3', 'z' => 'q3', '0' => 'q3', '1' => 'q3', '2' => 'q3', '3' => 'q3', '4' => 'q3', '5' => 'q3', '6' => 'q3', '7' => 'q3', '8' => 'q3', '9' => 'q3'),
    'q3' => array('a' => 'q3', 'b' => 'q3', 'c' => 'q3', 'd' => 'q3', 'e' => 'q3', 'f' => 'q3', 'g' => 'q3', 'h' => 'q3', 'i' => 'q3', 'j' => 'q3', 'k' => 'q3', 'l' => 'q3', 'm' => 'q3', 'n' => 'q3', 'o' => 'q3', 'p' => 'q3', 'q' => 'q3', 'r' => 'q3', 's' => 'q3', 't' => 'q3', 'u' => 'q3', 'v' => 'q3', 'w' => 'q3', 'x' => 'q3', 'y' => 'q3', 'z' => 'q3', '0' => 'q3', '1' => 'q3', '2' => 'q3', '3' => 'q3', '4' => 'q3', '5' => 'q3', '6' => 'q3', '7' => 'q3', '8' => 'q3', '9' => 'q3'),
    'q4' => array('0' => 'q4', '1' => 'q4', '2' => 'q4', '3' => 'q4', '4' => 'q4', '5' => 'q4', '6' => 'q4', '7' => 'q4', '8' => 'q4', '9' => 'q4'),
    'q5' => array('o' => 'q6','u' => 'q7', 'a' => 'q3', 'b' => 'q3', 'c' => 'q3', 'd' => 'q3', 'e' => 'q3', 'g' => 'q3', 'h' => 'q3', 'i' => 'q3', 'j' => 'q3', 'k' => 'q3', 'l' => 'q3', 'm' => 'q3', 'n' => 'q3', 'p' => 'q3', 'q' => 'q3', 'r' => 'q3', 's' => 'q3', 't' => 'q3', 'v' => 'q3', 'w' => 'q3', 'x' => 'q3', 'y' => 'q3','z' => 'q3'),
    'q6' => array('r' => 'q7', 'a' => 'q3', 'b' => 'q3', 'c' => 'q3', 'd' => 'q3', 'e' => 'q3', 'g' => 'q3', 'h' => 'q3', 'i' => 'q3', 'j' => 'q3', 'k' => 'q3', 'l' => 'q3', 'm' => 'q3', 'n' => 'q3', 'o' => 'q3', 'p' => 'q3', 'q' => 'q3', 's' => 'q3', 't' => 'q3', 'u' => 'q3', 'v' => 'q3', 'w' => 'q3', 'x' => 'q3', 'y' => 'q3', 'z' => 'q3'),
    'q7' => array('n' => 'q8','a' => 'q3', 'b' => 'q3', 'c' => 'q3', 'd' => 'q3', 'e' => 'q3', 'f' => 'q3', 'g' => 'q3', 'h' => 'q3', 'i' => 'q1', 'j' => 'q3', 'k' => 'q3', 'l' => 'q3', 'm' => 'q3', 'o' => 'q3', 'p' => 'q3', 'q' => 'q3', 'r' => 'q3', 's' => 'q3', 't' => 'q3', 'u' => 'q3', 'v' => 'q3', 'w' => 'q3', 'x' => 'q3', 'y' => 'q3', 'z' => 'q3', '0' => 'q3', '1' => 'q3', '2' => 'q3', '3' => 'q3', '4' => 'q3', '5' => 'q3',  '6' => 'q3', '7' => 'q3', '8' => 'q3', '9' => 'q3'),
    'q8' => array('h' => 'q9', 'r' => 'q9', 'c' => 'q9', 'a' => 'q3', 'b' => 'q3',  'd' => 'q3', 'e' => 'q3', 'f' => 'q3', 'g' => 'q3', 'i' => 'q3', 'j' => 'q3', 'k' => 'q3', 'l' => 'q3', 'm' => 'q3', 'n' => 'q3', 'o' => 'q3', 'p' => 'q3', 'q' => 'q3', 's' => 'q3', 't' => 'q3', 'u' => 'q3', 'v' => 'q3', 'w' => 'q3', 'x' => 'q3', 'y' => 'q3', 'z' => 'q3', '0' => 'q3', '1' => 'q3', '2' => 'q3', '3' => 'q3', '4' => 'q3', '5' => 'q3', '6' => 'q3', '7' => 'q3', '8' => 'q3', '9' => 'q3'),
    'q9' => array('i' => 'q10', 'n' => 'q11', 'a' => 'q10', 'b' => 'q3', 'c' => 'q3', 'd' => 'q3', 'e' => 'q3', 'f' => 'q3', 'g' => 'q3', 'h' => 'q3', 'j' => 'q3', 'k' => 'q3', 'l' => 'q3', 'm' => 'q3', 'o' => 'q3', 'p' => 'q3', 'q' => 'q3', 'r' => 'q3', 's' => 'q3', 't' => 'q3', 'u' => 'q3', 'v' => 'q3', 'w' => 'q3', 'x' => 'q3', 'y' => 'q3', 'z' => 'q3', '0' => 'q3', '1' => 'q3', '2' => 'q3', '3' => 'q3', '4' => 'q3', '5' => 'q3', '6' => 'q3', '7' => 'q3', '8' => 'q3', '9' => 'q3'),
    'q10' => array('l' => 'q11', 'i' => 'q9', 'a' => 'q3', 'b' => 'q3', 'c' => 'q3', 'd' => 'q3', 'e' => 'q3', 'f' => 'q3', 'g' => 'q3', 'h' => 'q3', 'j' => 'q3', 'k' => 'q3', 'm' => 'q3', 'n' => 'q3', 'o' => 'q11', 'p' => 'q3', 'q' => 'q3', 'r' => 'q3', 's' => 'q3', 't' => 'q3', 'u' => 'q3', 'v' => 'q3', 'w' => 'q3', 'x' => 'q3', 'y' => 'q3', 'z' => 'q3', '0' => 'q3', '1' => 'q3', '2' => 'q3', '3' => 'q3', '4' => 'q3', '5' => 'q3', '6' => 'q3', '7' => 'q3', '8' => 'q3', '9' => 'q3'),
    'q11' => array('e' => 'q12', 't' => 'q13', 'a' => 'q3', 'b' => 'q3', 'c' => 'q3', 'd' => 'q3', 'f' => 'q3', 'g' => 'q3', 'h' => 'q3', 'i' => 'q3', 'j' => 'q3', 'k' => 'q3', 'l' => 'q3', 'm' => 'q3', 'n' => 'q3', 'o' => 'q3', 'p' => 'q3', 'q' => 'q3', 'r' => 'q3', 's' => 'q3', 'u' => 'q3', 'v' => 'q3', 'w' => 'q3', 'x' => 'q3', 'y' => 'q3', 'z' => 'q3', '0' => 'q3', '1' => 'q3', '2' => 'q3', '3' => 'q3', '4' => 'q3', '5' => 'q3', '6' => 'q3', '7' => 'q3', '8' => 'q3', '9' => 'q3'),
    'q12' => array('a' => 'q3', 'b' => 'q3', 'c' => 'q3', 'd' => 'q3', 'e' => 'q3', 'f' => 'q3', 'g' => 'q3', 'h' => 'q3', 'i' => 'q3', 'j' => 'q3', 'k' => 'q3', 'l' => 'q3', 'm' => 'q3', 'n' => 'q3', 'o' => 'q3', 'p' => 'q3', 'q' => 'q3', 'r' => 'q3', 's' => 'q3', 't' => 'q3', 'u' => 'q3', 'v' => 'q3', 'w' => 'q3', 'x' => 'q3', 'y' => 'q3', 'z' => 'q3', '0' => 'q3', '1' => 'q3', '2' => 'q3', '3' => 'q3', '4' => 'q3', '5' => 'q3', '6' => 'q3', '7' => 'q3', '8' => 'q3', '9' => 'q3'),

    );

    private const CARACTERES_ESPECIAIS =
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
    'adicao' => '+',
    ];

    private $estado = 'q0';

    private $entrada = '';

    private $listToken = '';

    public function createListToken($entrada)
    {

        /**
         * POPULAR A LISTA DE TOKEN A PARTIR DO NOME E LEXEMA DA CLASS TOKEN
         */


        $this->setEntrada($entrada);
        $tokenAtual = [];
        $listTokens = [];
        $i = 0;
        $objToken = new Token();

        while ($i <= strlen($this->getEntrada())) {
            $lendo = $this->getEntrada()[$i];

            if (isset(AnalisadorLexico::DELTA[$this->getEstado()][$this->getEntrada()[$i]])) {
                $proximo_estado = AnalisadorLexico::DELTA[$this->getEstado()][$this->getEntrada()[$i]] ?: '';
                $this->setEstado($proximo_estado);
                $objToken->setLexema($objToken->getLexema() . $this->getEntrada()[$i]);
                $i++;
            } else {
                if (array_key_exists($this->getEstado(), AnalisadorLexico::ESTADOS_FINAIS)) {
                    $tokenAtual = array(AnalisadorLexico::ESTADOS_FINAIS[$this->getEstado()] => $objToken->getLexema());
                    array_push($listTokens, $this->populaObjetoToken($tokenAtual, $objToken));
                    $this->setListToken($listTokens);
                    $this->setEstado('q0');
                    $objToken = new Token();
                } else {
                    return $this->setIsAccept(false);
                }
            }
        }
        return $this->setIsAccept(true);
    }



    public function populaObjetoToken($tokenAtual, $objToken)
    {
        foreach ($tokenAtual as $key => $value) {
            $objToken->setNome($key);
            $objToken->setLexema($value);
        }
        return $objToken;
    }


    public function getEstado()
    {
        return $this->estado;
    }
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }
    public function getEntrada()
    {
        return $this->entrada;
    }

    public function setEntrada($entrada)
    {
        $this->entrada = $entrada;

        return $this;
    }

    public function getIsAccept()
    {
        return $this->isAccept;
    }

    public function setIsAccept($isAccept)
    {
        $this->isAccept = $isAccept;

        return $this;
    }
    public function setListToken($listToken)
    {
        return $this->listToken = $listToken;
    }

    /**
     * @return Token[]
     */
    public function getListToken()
    {
        return $this->listToken;
    }
}
