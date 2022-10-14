<?php

namespace src;

/**
<P>             ::= DEC ID ABRE_PAR <LISTA_PARAM> FECHA_PAR ABRE_BLOCO <LISTA_BLOCO> FECHA_BLOCO
<LISTA_PARAM>   ::= <PARAM> VIRGULA <LISTA_PARAM> | <PARAM>
<PARAM          ::= TIPO ID
<LISTA_BLOCO>   ::= <BLOCO> <LISTA_BLOCO> | EPSILON
<BLOCO>         ::= <ATR> | <SEL_IF>
<ATR>           ::= ID ATRIBUICAO <VAR>
<VAR>           ::= ID | CONST
<SEL_IF>        ::= IF ABRE_PAR ID COMPARA ID FECHA_PAR ABRE_BLOCO <BLOCO> FECHA_BLOCO
 */

/**
 * FIRSTS:
FIRST(P) : {DEC}
FIRST(LISTA_PARAM) : {VIRGULA, TIPO, EPSILON}
FIRST(PARAM) : {TIPO}
FIRST(LISTA_BLOCO) : {ID, IF, EPSILON}
FIRST(BLOCO): {ID, IF}
FIRST(ATR): ID
FIRST(SEL_IF): {IF}
FIRST(VAR): {ID, CONST}
FIRST(SEL_IF): {IF}

 */

 /**
  * FOLLOWS
FOLLOW(P): {$}
FOLLOW(LISTA_PARAM): {FECHA_PAR}
FOLLOW(PARAM): {FECHA_PAR, VIRGULA}
FOLLOW(LISTA_BLOCO): {FECHA_BLOCO}
FOLLOW(BLOCO): {ID, IF, FECHA_BLOCO}
FOLLOW(ATR):  {ID, IF, FECHA_BLOCO}
FOLLOW(SEL_IF):  {ID, IF, FECHA_BLOCO}
FOLLOW(VAR): {PV}

  */

require_once('AnalisadorLexico.php');
// $teste = new AnalisadorSintatico();
// $teste->startTest();


class SRL
{
    private $matrizSLR = [
        0 => ['DEC' => 'S2'],
        1 => ['$' => 'ACC'],
        2 => ['ID' => 'S3'],
        3 => ['ABRE_PAR' => 'S4'],
        4 => ['TIPO' => 'S5', 'VIRGULA'=>'S8'],
        5 => ['ID' => 'S6'],
        6 => ['FECHA_PAR' => 'R2', 'VIRGULA'=>'R2'],
        7 => ['FECHA_PAR' => 'S10'],
        8 => ['TIPO' => 'S5'],
        9 => ['VIRGULA' => 'S8', 'FECHA_PAR'=>'R1'],
        10 => ['ABRE_BLOCO' => 'S11'],
        11 => ['IF' => 'S22', 'ID'=>'S16'],
        12 => ['FECHA_BLOCO' => 'S31'],
        13 => ['ID' => 'S2'],
        14 => [],
        15 => [],
        16 => ['ATRIBUICAO' => 'S17'],
        17 => ['ID' => 'S19', 'CONST'=>'S20'],
        18 => ['PV' => 'S21'],
        19  => ['PV' => 'R1'],
        20 => ['PV' => 'R1'],
        21 => ['ID' => 'R4'],

        /**
         * olhar o video e pegar como exemplo
         *
         * tem a ferramente gals e ver como é gerado as tabelas la
         *
         * o retorno do front é validar só se é aceito ou nao
         *
         *
         *
         */

    ];
    }