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
        'FUN' => array('FUN','ABRE_PARENTESES', 'LISTAVAR','FECHA_PARENTESES','ABRE_CHAVE', 'BLOCO','FECHA_CHAVE'),
        'LISTA_VAR'=> array('VAR' => array('LISTAVAR'), 'FECHA_PARENTESES'=>''),
        'VAR'=> array('ID'=>'ID','CONST'=>'CONST'),
        'BLOCO'=> array('ATRIB'=>'ATRIB', 'DECLARACAO'=>'DECLARACAO'),
        'ATRIB'=> array('ID','IGUAL','VAR'),
        'DECLARACAO' => array('DEC'=>'ID'));


    private $lexico;

    $TESTE = AnalisadorPreditivo::TABELA_M['fun'];


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
