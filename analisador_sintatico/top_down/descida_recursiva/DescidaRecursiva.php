<?php

namespace src;

/*
 * author Roni Deringer <ronideringer.ifc@gmail.com>
 */
$teste = new DescidaRecursiva();
$teste->start();

?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>text</title>
 </head>
 <body>
 <br>
<br>
<br>
 <img src="example.png" width="700px" height="300px">
<br>
 </body>
 </html>
 <?php

    class DescidaRecursiva
    {
        private $cont = 0;
        private $anterior;
        private $listToken = ['INT', 'MULTIPLICAÇÃO', 'INT'];

        public function start()
        {
            echo($this->getListToken()[0]);
            echo('<br>');

            echo($this->getListToken()[1]);
            echo('<br>');

            echo($this->getListToken()[2]);
            echo('<br>');
            echo('<br>');

            echo ('VAI DAR ERRO PQ A GRAMATICA TA ERRADA!');
            echo ('ele vai ler o primeiro [int]  e nao vai retornar true e finaliza');
            echo '<br>';
            echo '<br>';

            $this->e();
        }

        public function terminal($token)
        {
            $ret = $this->getListToken()[$this->getCont()] ==  $token;
            $this->setCont($this->getCont() + 1);
            return $ret;
        }

        public function e1()
        {
            echo 'e1 - ';
            return $this->t();
        }

        public function e2()
        {
            echo 'e2 - ';
            return $this->t() && $this->terminal('MAIS') && $this->e();
        }

        public function e()
        {
            echo 'e - ';
            $this->setAnterior($this->getCont());

            if ($this->e1()) {
                return true;
            }
            $this->setCont($this->getAnterior());
            return $this->e2();
        }

        public function t1()
        {
            echo 't1 - ';
            return $this->terminal('INT');
        }

        public function t2()
        {
            echo 't2 - ';
            return $this->terminal('INT') && $this->terminal('MULTIPLICAÇÃO') && $this->t();
        }

        public function t3()
        {
            echo 't3 - ';
            return $this->terminal('AP') && $this->e() && $this->terminal('FP');
        }

        public function t()
        {
            echo 't - ';
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


/**
 * criar uma classe nova
 * chmar o analise lexica
 * pegar lista tokens
 * e validar pelo analisador sintatico
 * retornar true oou false
 * e dar um echo mostranado se é aceito ou nao
 *
 *
 * CRIAR UM OBJETO Q VAI TER
 *    NOME = token
    lexema = entrada atual (palavra ususe)
    pos inicial
    pos final
 *
 *
 */
