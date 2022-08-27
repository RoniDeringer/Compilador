<?php

namespace src;

/**
 * @author Roni Deringer
 */

class AnalisadorSintatico
{
    public function teste($lexico)
    {

        return $lexico->getListToken()[0];
    }
}
