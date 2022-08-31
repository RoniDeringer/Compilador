<?php

namespace src;

use OutOfRangeException;

/**
 * @author Roni Deringer
 */

class AnalisadorSintatico
{
    public $lexico;
    public $cont = 0;
    public $anterior;


    public function start($lexico)
    {
        $this->setLexico($lexico);
        $this->s();
    }


    public function term($token)
    {
        $this->setCont($this->getCont() + 1);
        $ret = $this->getLexico()->getListToken()[$this->getCont()]->getNome() == $token;
        return $ret;
    }


 /**
  * S --------------------
  */
    public function s()
    {
        if ($this->s1()) {
            return true;
        } else {
            $this->setCont($this->getAnterior());
            return $this->s2(); //nao posso chamar o corpo()  direto?
        }
    }

    public function s1()
    {
        echo 'S               ::=     funcao( LISTA_PARAMETRO ){ LISTA_CORPO } ';
        return
        $this->term('funcao') and
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
        echo 'LISTA_CORPO     ::=     CORPO LISTA_CORPO | CORPO';
        if ($this->listaCorpo1()) {
            return true;
        } else {
            $this->setCont($this->getAnterior());
            return $this->listaCorpo2();
        }
    }

    public function listaCorpo1()
    {
        echo 'LISTA_CORPO     ::=     CORPO LISTA_CORPO';
        return
        $this->corpo() and
        $this->listaCorpo();
    }

    public function listaCorpo2()
    {
        echo 'LISTA_CORPO     ::=      CORPO';
        return
        $this->corpo();
    }

    /**
     * CORPO ---------------
     */
    public function corpo()
    {
        echo 'CORPO           ::=     IMPRIMA | VARIAVEL | IF';
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
        if ($this->listaParametro1()) {
            return true;
        } else {
            $this->setCont($this->getAnterior());
            return $this->listaParametro2();
        }
    }

    public function listaParametro1()
    {
        echo 'LISTA_PARAMETRO ::=     VARIAVEL LISTA_PARAMETRO';
        return
        $this->variavel() and
        $this->listaParametro();
    }

    public function listaParametro2()
    {
        echo 'LISTA_PARAMETRO ::=     | VARIAVEL';

        return
        $this->variavel();
    }


/**
 * IMPRIMA ----------
 */
    public function imprima()
    {
        echo 'IMPRIMA         ::=     imprima NOMEVARIAVEL';
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
        return
        $this->nomeVariavel() and
        $this->term('=') and
        $this->letras();
    }

/**
 * if ----------
 */
    public function if()
    {
        echo 'IF              ::=     if( BLOCO )';
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
        return $this->term('numeros');
    }

/**
 * NOMEVARIAVEL ----------
 */
    public function nomeVariavel()
    {
        echo 'NOMEVARIAVEL    ::=     LETRAS';
        return $this->term('letras');
    }


/**
 * LETRAS ----------
 */
    public function letras()
    {
        return $this->term('[a-zA-Z');
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
