<?php

namespace src;

use OutOfRangeException;

require_once('AnalisadorLexico.php');
// $teste = new AnalisadorSintatico();
// $teste->startTest();


class AnalisadorSintatico
{
    private $lexico;
    private $cont = -1;
    private $anterior;
    private $newListToken = [];
    public $listTransicaoGramatica = [];
    private $isAcceptSintatico = false;

    public function start($lexico)
    {
        $newListToken = [];
        $this->setLexico($lexico);

        /**
         * recebe o nome dos tokens em um array simples
         */
        foreach ($lexico->getListToken() as $objetoToken) {
            array_push($newListToken, $objetoToken->getNome());
        }
        $this->setNewListToken($newListToken);
        // var_dump($this->getNewListToken());
        $this->s();
    }


    /**
     * funcao apenas para teste
     */
    public function startTest()
    {
        $lexico = new \src\AnalisadorLexico();

        $this->setLexico($lexico);
        $this->getLexico()->setListToken([
                                    0 => 'FUNCAO',
                                    1 => 'abre_parenteses',
                                    2 => 'VARIAVEL',
                                    3 => 'fecha_parenteses',
                                    4 => 'abre_chave',
                                    5 => 'imprima',
                                    6 => 'VARIAVEL',
                                    7 => 'fecha_chave',
                                ]);
                                    //no TERM ele nao reconhece as chaves strings
        $this->s();
    }


    public function term($token)
    {
        $this->setCont($this->getCont() + 1);
        $ret = $this->getNewListToken()[$this->getCont()] == $token;
        return $ret;
    }


 /**
  * S --------------------
  */
    public function s()
    {
        if ($this->s1()) {
            $this->setIsAcceptSintatico(true);
            return true;
        } else {
            $this->setCont($this->getAnterior());
            return $this->s2();
        }
    }

    public function s1()
    {
        array_push($this->listTransicaoGramatica, 'S               ::=     funcao( LISTA_PARAMETRO ){ LISTA_CORPO } ');
        return
        $this->term('FUNCAO') and
        $this->term('abre_parenteses') and
        $this->listaParametro() and
        $this->term('fecha_parenteses') and
        $this->term('abre_chave') and
        $this->listaCorpo() and
        $this->term('fecha_chave');
    }

    public function s2()
    {
        return $this->listaCorpo();
    }


    /**
     * LISTA_CORPO ---------------
     */
    public function listaCorpo()
    {
        array_push($this->listTransicaoGramatica, 'LISTA_CORPO     ::=     & | CORPO | CORPO LISTA_CORPO');
        if ($this->listaCorpo1()) {
            return true;
        } else {
            $this->setCont($this->getAnterior());
            if ($this->listaCorpo2()) {
                return true;
            } else {
                $this->setCont($this->getAnterior());
                return $this->listaCorpo3();
            }
        }
    }

    public function listaCorpo1()
    {
        return true; //corpo vazio
    }

    public function listaCorpo2()
    {
        array_push($this->listTransicaoGramatica, 'LISTA_CORPO     ::=      CORPO');
        return
        $this->corpo();
    }

    public function listaCorpo3()
    {
        array_push($this->listTransicaoGramatica, 'LISTA_CORPO     ::=     CORPO LISTA_CORPO');
        return
        $this->corpo() and
        $this->listaCorpo();
    }


    /**
     * CORPO ---------------
     */
    public function corpo()
    {
        array_push($this->listTransicaoGramatica, 'CORPO           ::=     IMPRIMA | VARIAVEL | IF');
        $this->setAnterior($this->getCont());
        if ($this->corpo1()) {
            return true;
        } else {
            $this->setCont($this->getAnterior());
            if ($this->corpo2()) {
                return true;
            } else {
                $this->setCont($this->getAnterior());
                return $this->corpo3();
            }
        }
    }


    public function corpo1()
    {
        return $this->imprima();
    }


    public function corpo2()
    {
        return $this->variavel();
    }


    public function corpo3()
    {
        return $this->if();
    }

    /**
     * LISTA_PARAMETRO
     */
    public function listaParametro()
    {
        array_push($this->listTransicaoGramatica, 'LISTA_PARAMETRO ::=     & | VARIAVEL LISTA_PARAMETRO | VARIAVEL (ARRUMAR)');

        $this->setAnterior($this->getCont());
        if ($this->listaParametro1()) {
            return true;
        } else {
            $this->setCont($this->getAnterior());
            if ($this->listaParametro2()) {
                return true;
            } else {
                $this->setCont($this->getAnterior());
                return $this->listaParametro3();
            }
        }
    }



    public function listaParametro1()
    {
        array_push($this->listTransicaoGramatica, 'LISTA_PARAMETRO ::=     VARIAVEL');
        return
        $this->variavel();
    }

    public function listaParametro2()
    {
        array_push($this->listTransicaoGramatica, 'LISTA_PARAMETRO ::=     VARIAVEL LISTA_PARAMETRO');
        return
        $this->variavel() and
        $this->listaParametro();
    }

    public function listaParametro3()
    {
        array_push($this->listTransicaoGramatica, 'LISTA_PARAMETRO ::=     &');
        return $this->transicaoVazia();
    }

/**
 * IMPRIMA ----------
 */
    public function imprima()
    {
        array_push($this->listTransicaoGramatica, 'IMPRIMA         ::=     imprima VARIAVEL');
        return
        $this->term('imprima') and
        $this->variavel();
    }

/**
 * TRANSIÇÃO VAZIA ----------
 */
    public function transicaoVazia()
    {
        return true;
    }

/**
 * VARIAVEL ----------
 */
    public function variavel()
    {
        return $this->term('VARIAVEL');
    }

/**
 * if ----------
 */
    public function if()
    {
        array_push($this->listTransicaoGramatica, 'IF              ::=     if( BLOCO )');
        return
        $this->term('if') and
        $this->bloco();
    }

/**
 * BLOCO ----------
 */
    public function bloco()
    {
        array_push($this->listTransicaoGramatica, 'BLOCO           ::=     PARAM OPERADOR PARAM');
        return
        $this->param() and
        $this->operador() and
        $this->param();
    }


/**
 * operador ----------
 */
    public function operador()
    {
        array_push($this->listTransicaoGramatica, 'OPERADOR        ::=     > | < | == | !=');
        $this->setAnterior($this->getCont());
        if ($this->term('maior')) {
            return true;
        } else {
            $this->setCont($this->getAnterior());
            if ($this->term('menor')) {
                return true;
            } else {
                $this->setCont($this->getAnterior());
            }
            if ($this->term('igual')) {
                return true;
            } else {
                $this->setCont($this->getAnterior());
                return $this->term('diferente');
            }
        }
    }



/**
 * PARAM ----------
 */
    public function param()
    {
        array_push($this->listTransicaoGramatica, 'PARAM           ::=     VARIAVEL | CONST');
        $this->setAnterior($this->getCont());
        if ($this->variavel()) {
            return true;
        } else {
            $this->setCont($this->getAnterior());
            return $this->const();
        }
    }


/**
 * CONST ----------
 */
    public function const()
    {
        array_push($this->listTransicaoGramatica, 'CONST           ::=     NUMEROS');
        return $this->term('Número');
    }





    public function getLexico()
    {
        return $this->lexico;
    }

    public function setLexico($lexico)
    {
        return $this->lexico = $lexico;
    }

    public function getAnterior()
    {
        return $this->anterior;
    }

    public function setAnterior($anterior)
    {
        return $this->anterior = $anterior;
    }

    public function getCont()
    {
        return $this->cont;
    }

    public function setCont($cont)
    {
        $this->cont = $cont;

        return $this;
    }

    public function getNewListToken()
    {
        return $this->newListToken;
    }

    public function setNewListToken($newListToken)
    {
        return $this->newListToken = $newListToken;
    }

    public function getListTransicaoGramatica()
    {
        return $this->listTransicaoGramatica;
    }

    public function setListTransicaoGramatica($listTransicaoGramatica)
    {
        return $this->listTransicaoGramatica = $listTransicaoGramatica;
    }

    public function getIsAcceptSintatico()
    {
        return $this->isAcceptSintatico;
    }

    public function setIsAcceptSintatico($isAcceptSintatico)
    {
        $this->isAcceptSintatico = $isAcceptSintatico;

        return $this;
    }
}
