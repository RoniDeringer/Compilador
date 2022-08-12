<?php

$entrada= 'teste';
 $delta = array('a'=>'1', 'b'=>'2');
$estado = 'q0';


$estado = $delta[$estado][$entrada[0]];


echo $entrada[0];

var_dump($estado);

