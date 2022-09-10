<?php

namespace src;

use OutOfRangeException;

require_once('AnalisadorLexico.php');
// $teste = new AnalisadorSintatico();
// $teste->startTest();


class AnalisadorPreditivo
{
    private const NAO_TERMINAL = array('FUN','LISTA_VAR','VAR','BLOCO','ATRIB','DECLARACAO');

    private const TABELA_M = array(
        'FUN' => array( )
    );

    private $lexico;


    public function start(\src\AnalisadorLexico $lexico)
    {
        $this->setLexico($lexico);
        $this->validaPreditiva();
    }

    public function validaPreditiva()
    {
    }




    public function setLexico($lexico)
    {
        return $this->lexico = $lexico;
    }
    public function getLexico()
    {
        return $this->lexico;
    }
}
