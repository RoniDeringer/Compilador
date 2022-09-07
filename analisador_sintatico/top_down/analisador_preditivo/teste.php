<?php

namespace src;

use OutOfRangeException;

require_once('AnalisadorLexico.php');
// $teste = new AnalisadorSintatico();
// $teste->startTest();


class AnalisadorPreditivo
{
    private const terminal = array('FUN', 'LISTAVAR', 'VAR', 'BLOCO', 'ATRIB', 'DECLARACAO');

    private const m = array(
        'fun' => array( )
    )
}
