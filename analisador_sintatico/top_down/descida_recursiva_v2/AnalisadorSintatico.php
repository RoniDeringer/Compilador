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


    public function validateOrderToken($lexico)
    {
        $ret = $this->getLexico()->getListToken()[$this->getCont()];
        return $ret;



        // // $this->setLexico($lexico);
        // $this->s();
    }



    public function term($token)
    {
        $ret = $this->getLexico()->getListToken()[$this->getCont()];
        return $ret;

        // $ret = $this->getListToken()[$this->getCont()] ==  $token;
        // $this->setCont($this->getCont() + 1);
        // // return $ret;
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
        return
        $this->term('funcao') and
        $this->term('abre_parenteses') and
        $this->corpo() and
        $this->term('fecha_parenteses');
    }

    public function s2()
    {
        return $this->corpo(); //nao posso chamar o corpo()  direto?
    }


    /**
     * CORPO ---------------
     */
    public function corpo()
    {
        $this->setAnterior($this->getCont());
        if ($this->imprima()) {
            return true;
        } else {
            $this->setCont($this->getAnterior());
            if ($this->variavel()) {
                return true;
            } else {
                $this->setCont($this->getAnterior());
                return $this->if();
            }
        }
    }


/**
 * IMPRIMA ----------
 */
    public function imprima()
    {
        return
        $this->term('imprima') and
        $this->nomeVariavel();
    }

/**
 * VARIAVEL ----------
 */
    public function variavel()
    {
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
        return
        $this->term('if') and
        $this->bloco();
    }

/**
 * BLOCO ----------
 */
    public function bloco()
    {
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
        return 0;   //////?????????????????
    }


/**
 * PARAM ----------
 */
    public function param()
    {
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
        return $this->term('numeros');
    }

/**
 * NOMEVARIAVEL ----------
 */
    public function nomeVariavel()
    {
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
