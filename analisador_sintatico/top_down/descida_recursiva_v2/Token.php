<?php

namespace src;

/**
 * @author Roni Deringer
 */


class Token
{
    private $nome = '';

    private $lexema = '';

    private $posInicial;

    private $posFinal;





    public function getLexema()
    {
        return $this->lexema;
    }

    public function setLexema($lexema)
    {
        $this->lexema = $lexema;

        return $this;
    }

    public function getPosInicial()
    {
        return $this->posInicial;
    }

    public function setPosInicial($posInicial)
    {
        $this->posInicial = $posInicial;

        return $this;
    }
    public function getPosFinal()
    {
        return $this->posFinal;
    }

    public function setPosFinal($posFinal)
    {
        $this->posFinal = $posFinal;

        return $this;
    }

    public function getNome()
    {
        return $this->nome;
    }
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }
}
