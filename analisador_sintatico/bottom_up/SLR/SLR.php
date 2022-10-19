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


    /**
     * @param array()
     */
    public function start($listToken)
    {
        foreach ($listToken as $token) {
            return $this->validaSLR($token->getNome());
        }
    }



    public function validaSLR($token)
    {
        return ($token);
    }
}
