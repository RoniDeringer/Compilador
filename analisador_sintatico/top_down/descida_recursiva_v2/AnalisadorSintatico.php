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


 /**
  * S
  */
    public function s()
    {
        if ($this->s1()) {
            return true;
        } else {
            $this->setCont($this->getAnterior());
            return s2();
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
        return $this->corpo();
    }



    public function term($token)
    {
        $ret = $this->getLexico()->getListToken()[$this->getCont()];
        return $ret;

        // $ret = $this->getListToken()[$this->getCont()] ==  $token;
        // $this->setCont($this->getCont() + 1);
        // // return $ret;
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
