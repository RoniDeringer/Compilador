<?php

namespace src;

/*
 * author Roni Deringer <ronideringer.ifc@gmail.com>
 */
$teste = new DescidaRecursiva();
$teste->start();


class DescidaRecursiva
{
    private $cont = 0;
    private $anterior;
    private $listToken = ['INT', 'MULTIPLICAÇÃO', 'INT'];

    public function start()
    {
        $this->e();
    }

    public function terminal($token)
    {

   //  $this->setLexema($this->getLexema() . $this->getEntrada()[$i]);

        $lendo = $this->getListToken()[$this->getCont()];
        $ret = $lendo . $token;
        $teste = $lendo . $token == $token;

        // $ret = $this->getListToken()[$this->getCont()] $token == $token;
        //ret = lista_tk[cont].token == token
        $this->setCont($this->getCont() + 1);
        return $ret;
    }

    public function e1()
    {
        return $this->t();
    }

    public function e2()
    {
        return $this->t() && $this->terminal('MAIS') && $this->e();
    }

    public function e()
    {
        $this->setAnterior($this->getCont());

        if ($this->e1()) {
            return true;
        }
        $this->setCont($this->getAnterior());
        return $this->e2();
    }

    public function t1()
    {
        return $this->terminal('INT');
    }

    public function t2()
    {
        return $this->terminal('INT') && $this->terminal('MULTIPLICAÇÃO') && $this->t();
    }

    public function t3()
    {
        return $this->terminal('AP') && $this->e() && $this->terminal('FP');
    }

    public function t()
    {
        $this->setAnterior($this->getCont());
        if ($this->t1()) {
            return true;
        } else {
            $this->setCont($this->getAnterior());
            if ($this->t2()) {
                return true;
            } else {
                $this->setCont($this->getAnterior());
                return $this->t3();
            }
        }
    }



    //GETTER AND SETTERS
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
        return $this->cont = $cont;
    }

    public function getListToken()
    {
        return $this->listToken;
    }

    public function setListToken($listToken)
    {
        $this->listToken = $listToken;

        return $this;
    }
}
