<?php
include __DIR__ . '/css/style.php';
echo '<h1>Análise Sintática - Descida Recursiva</h1>';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>descidaRecursiva</title>
</head>
<body>
<pre>
    <h2>Linguagem esperada:</h2>
    funcao nome (variavel){
    tipo variavel = valor
    if(valor > numero){
        imprime (valor)
    }
}
chama nome()
</pre>
</body>
</html>

<?php

require_once('AnalisadorLexico.php');
require_once('AnalisadorSintatico.php');
$lexico = new src\AnalisadorLexico();
$sintatico = new src\AnalisadorSintatico($lexico);

if ($sinatico->validaCodigo() ==true ){
    echo "codigo aceito";
}else{
    echo "codigo invalido";
}



