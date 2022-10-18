<?php

namespace src;

require_once('Token.php');
require_once('AnalisadorLexico.php');


class SRL
{
    public $matrizSLR = [
        0 => ['DEC' => 'ACC'],
    ];

    public $goto = [];

    public $tokens = [];

    public function validaSLR()
    {
        while (true) {
            $s = end($aPilhaEstados);
            printf('<br>%s<br>', $a);
            printf('Pilha estados: %s', implode(',', $aPilhaEstados));
            if (strpos($aAction[$s][$a], 'S') !== false) {
                $t = intval(str_replace('S', '', $aAction[$s][$a]));
                array_push($aPilhaEstados, $t);
                $a = nextToken();
            } elseif (strpos($aAction[$s][$a], 'R') !== false) {
                $r = intval(str_replace('R', '', $aAction[$s][$a]));
                array_splice($aPilhaEstados, $r);
                $g = $aGoTo[$s];
                array_push($aPilhaEstados, $g);
            } elseif ($aAction[$s][$a] == 'ACC') {
                exit;
            } else {
                $sErro = 'Erro ao analisar a linguagem';
                exit;
            }
        }
    }
}
