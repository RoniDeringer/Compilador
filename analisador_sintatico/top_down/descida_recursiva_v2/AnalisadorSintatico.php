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
        $this->lista_parametro() and
        $this->term('fecha_parenteses')and
        $this->term('abre_chave')and
        $this->lista_corpo()and
        $this->term('fecha_chave');
    }

    public function s2()
    {
        return $this->lista_corpo();
    }


    /**
     * LISTA_CORPO ---------------
     */
    public function lista_corpo()
    {
        if ($this->lista_corpo1()) {
            return true;
        } else {
            $this->setCont($this->getAnterior());
            return $this->lista_corpo2();
        }
    }

    public function lista_corpo1(){
        return
        $this->corpo() and
        $this->lista_corpo();
    }

    public function lista_corpo2(){
        return
        $this->corpo();
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
     * LISTA_PARAMETRO
     */
    public function lista_parametro()
    {
        if ($this->lista_parametro1()) {
            return true;
        } else {
            $this->setCont($this->getAnterior());
            return $this->lista_parametro2();
        }
    }

    public function lista_parametro1()
    {
        return
        $this->variavel() and
        $this->lista_parametro();
    }

    public function lista_parametro2()
    {
        return
        $this->parametro();
    }

    /**
    * PARAMETRO
    */
    public function parametro()
    {
        return $this->variavel();
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
        {
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
                if($this->term('igual')){
                    return true;
                }else{
                    $this->setCont($this->getAnterior());
                    return $this->term('diferente');

                }

            }
        }
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
