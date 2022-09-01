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

        var_dump($newListToken);

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
        $ret = $this->getLexico()->getListToken()[$this->getCont()] == $token;
        return $ret;
    }


 /**
  * S --------------------
  */
    public function s()
    {
        if ($this->s1()) {
            echo 'deu boa';
            return true;
        } else {
            $this->setCont($this->getAnterior());
            return $this->s2();
        }
    }

    public function s1()
    {
        echo 'S               ::=     funcao( LISTA_PARAMETRO ){ LISTA_CORPO } ';
        echo '<br>';
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
        echo 'LISTA_CORPO     ::=     CORPO | CORPO LISTA_CORPO';
        echo '<br>';
        if ($this->listaCorpo1()) {
            return true;
        } else {
            $this->setCont($this->getAnterior());
            return $this->listaCorpo2();
        }
    }

    public function listaCorpo1()
    {
        echo 'LISTA_CORPO     ::=      CORPO';
        echo '<br>';
        return
        $this->corpo();
    }

    public function listaCorpo2()
    {
        echo 'LISTA_CORPO     ::=     CORPO LISTA_CORPO';
        echo '<br>';
        return
        $this->corpo() and
        $this->listaCorpo();
    }


    /**
     * CORPO ---------------
     */
    public function corpo()
    {
        echo 'CORPO           ::=     IMPRIMA | VARIAVEL | IF';
        echo '<br>';
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
        echo 'LISTA_PARAMETRO ::=     VARIAVEL LISTA_PARAMETRO | VARIAVEL (ARRUMAR)';
        echo '<br>';


        $this->setAnterior($this->getCont());

        if ($this->listaParametro1()) {
            return true;
        } else {
            $this->setCont($this->getAnterior());
            return $this->listaParametro2();
        }
    }

    public function listaParametro1()
    {
        echo 'LISTA_PARAMETRO ::=     | VARIAVEL';
        echo '<br>';

        return
        $this->variavel();
    }


    public function listaParametro2()
    {
        echo 'LISTA_PARAMETRO ::=     VARIAVEL LISTA_PARAMETRO';
        echo '<br>';
        return
        $this->variavel() and
        $this->listaParametro();
    }


/**
 * IMPRIMA ----------
 */
    public function imprima()
    {
        echo 'IMPRIMA         ::=     imprima NOMEVARIAVEL';
        echo '<br>';
        return
        $this->term('imprima') and
        $this->nomeVariavel();
    }

/**
 * VARIAVEL ----------
 */
    public function variavel()
    {
        echo 'VARIAVEL        ::=     NOMEVARIAVEL = LETRAS';
        echo '<br>';

        return $this->nomeVariavel();

        // return
        // $this->nomeVariavel() and
        // $this->term('=') and
        // $this->letras();
    }

/**
 * if ----------
 */
    public function if()
    {
        echo 'IF              ::=     if( BLOCO )';
        echo '<br>';
        return
        $this->term('if') and
        $this->bloco();
    }

/**
 * BLOCO ----------
 */
    public function bloco()
    {
        echo'BLOCO           ::=     PARAM OPERADOR PARAM';
        echo '<br>';
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
        echo'OPERADOR        ::=     > | < | == | !=';
        echo '<br>';
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
        echo'PARAM           ::=     NOMEVARIAVEL | CONST';
        echo '<br>';
        $this->setAnterior($this->getCont());
        if ($this->nomeVariavel()) {
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
        echo'CONST           ::=     NUMEROS';
        echo '<br>';
        return $this->term('numeros');
    }

/**
 * NOMEVARIAVEL ----------
 */
    public function nomeVariavel()
    {
        echo 'NOMEVARIAVEL    ::=     LETRAS';
        echo '<br>';
        return $this->term('VARIAVEL');
    }


/**
 * LETRAS ----------
 */
    public function letras()
    {
        return $this->term('[a-zA-Z');
        echo '<br>';
    }




    public function getLexico()
    {
        return $this->lexico;
    }

    public function setLexico($lexico)
    {
        $this->lexico = $lexico;

        return $this;
    }
    public function getAnterior()
    {
        return $this->anterior;
    }
    public function setAnterior($anterior)
    {
        $this->anterior = $anterior;

        return $this;
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
}
