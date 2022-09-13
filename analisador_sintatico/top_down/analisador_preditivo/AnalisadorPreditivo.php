<?php

namespace src;

use OutOfRangeException;

require_once('AnalisadorLexico.php');
// $teste = new AnalisadorSintatico();
// $teste->startTest();


class AnalisadorPreditivo
{
    private $naoTerminal = array('FUN','LISTA_VAR','VAR','BLOCO','ATRIB','DECLARACAO');

    private $tabelaM = array(
        'FUN' => array('funcao','abre_parenteses', 'LISTAVAR','fecha_parenteses','ABRE_CHAVE', 'BLOCO','FECHA_CHAVE'),
        'LISTA_VAR' => array('VAR' => array('LISTAVAR'), 'fecha_parenteses' => ''),
        'VAR' => array('ID' => 'ID','CONST' => 'CONST'),
        'BLOCO' => array('ATRIB' => 'ATRIB', 'DECLARACAO' => 'DECLARACAO'),
        'ATRIB' => array('ID','IGUAL','VAR'),
        'DECLARACAO' => array('DEC' => 'ID'));


    private $terminais = array(
        'funcao',
        'fecha_parenteses',
        'abre_parenteses',
        'abre_chave',
        'fecha_chave',
        'ID',
        'CONST',
        'IGUAL',
        'dec'
    );

    public $pilha = ['$'];
    public $listTokens = [];

    public function __construct($lexico)
    {
        $this->lexico = $lexico;
        $this->listTokens = $lexico->getListToken();
    }

    public function validaPreditivo()
    {
        $this->pilha[] = 'FUN';
        $cont = 0;
        $token = $this->tokens[0];

        do {
            if ($this->isTerminal(end($this->pilha))) {
                if (end($this->pilha) == $token->listTokens) {
                    array_pop($this->pilha);
                    $cont++;
                    $token = $this->nextToken($cont);
                } else {
                    var_dump($this->pilha);
                    return false;
                }
            } else {
                $producao = $this->tabelaM[end($this->pilha)][$token->listTokens];
                $this->empilhar($producao);
            }
        } while (end($this->pilha) != '$');
        return true;
    }


    public function isTerminal($x)
    {
        return in_array($x, $this->terminais);
    }

    public function empilhar($producao)
    {
        array_pop($this->pilha);
        $this->pilha = array_merge($this->pilha, array_reverse($producao));
    }

    public function nextToken($cont)
    {
        if (count($this->listTokens) <= $cont) {
            return;
        }
        return $this->tokens[$cont];
    }
}
